<?php

namespace frontend\controllers;

use common\models\CarrinhoCompra;
use common\models\Fatura;
use common\models\FaturaSearch;
use common\models\LinhaCarrinho;
use common\models\LinhaFatura;
use common\models\Produto;
use common\models\ReceitaMedica;
use common\models\Servico;
use common\models\User;
use Mpdf\Mpdf;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaturaController implements the CRUD actions for Fatura model.
 */
class FaturaController extends Controller
{
    /**
     * @inheritDoc
     */
    // Método que permite definir o que o utilizador tem permissão para fazer
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'imprimir'],
                            'allow' => true,
                            'roles' => ['cliente'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Fatura models.
     *
     * @return string
     */
    // Método que vai para o index das faturas
    public function actionIndex($id)
    {
        $searchModel = new FaturaSearch();

        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['cliente_id' => $id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fatura model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Método que vai para a view de uma fatura
    public function actionView($id)
    {
        $fatura = $this->findModel($id);

        $cliente = User::find()->where(['id' => $fatura->cliente_id])->one();
        $perfilCliente = $cliente->profiles;

        $linhasFatura = LinhaFatura::find()->where(['fatura_id' => $id])->all();

        $carrinho = CarrinhoCompra::find()->where(['fatura_id' => $id])->one();

        $servicosIds = ArrayHelper::getColumn($linhasFatura, 'servico_id');
        $servicos = Servico::find()->where(['id' => $servicosIds])->all();

        $receitasIds = ArrayHelper::getColumn($linhasFatura, 'receita_medica_id');
        $receitas = ReceitaMedica::find()->where(['id' => $receitasIds])->all();

        $totallinhas = $linhasFatura;

        if ($carrinho !== null) {
            $carrinhoId = $carrinho->id;
            $linhasCarrinho = LinhaCarrinho::find()->where(['carrinho_compra_id' => $carrinhoId])->all();

            $produtos = [];
            foreach ($linhasCarrinho as $linhaCarrinho) {
                $produto = Produto::find()->where(['id' => $linhaCarrinho->produto_id])->one();
                if ($produto) {
                    $produtos[] = $produto;
                }
            }

            return $this->render('view', [
                'fatura' => $fatura,
                'cliente' => $cliente,
                'perfilCliente' => $perfilCliente,
                'linhasFatura' => $linhasFatura,
                'servicos' => $servicos,
                'receitas' => $receitas,
                'linhasCarrinho' => $linhasCarrinho,
                'produtos' => $produtos,
                'totallinhas' => $totallinhas,
            ]);
        } else {
            return $this->render('view', [
                'fatura' => $fatura,
                'cliente' => $cliente,
                'perfilCliente' => $perfilCliente,
                'linhasFatura' => $linhasFatura,
                'servicos' => $servicos,
                'receitas' => $receitas,
                'totallinhas' => $totallinhas,
            ]);
        }
    }


    //Método que permite imprimir uma fatura
    public function actionImprimir($id)
    {
        $fatura = $this->findModel($id);

        $cliente = User::find()->where(['id' => $fatura->cliente_id])->one();
        $perfilCliente = $cliente->profiles;

        $linhasFatura = LinhaFatura::find()->where(['fatura_id' => $id])->all();

        $carrinho = CarrinhoCompra::find()->where(['fatura_id' => $id])->one();

        $servicosIds = ArrayHelper::getColumn($linhasFatura, 'servico_id');
        $servicos = Servico::find()->where(['id' => $servicosIds])->all();

        $receitasIds = ArrayHelper::getColumn($linhasFatura, 'receita_medica_id');
        $receitas = ReceitaMedica::find()->where(['id' => $receitasIds])->all();

        $totallinhas = $linhasFatura;

        if ($carrinho !== null) {
            $carrinhoId = $carrinho->id;
            $linhasCarrinho = LinhaCarrinho::find()->where(['carrinho_compra_id' => $carrinhoId])->all();

            $produtos = [];
            foreach ($linhasCarrinho as $linhaCarrinho) {
                $produto = Produto::find()->where(['id' => $linhaCarrinho->produto_id])->one();
                if ($produto) {
                    $produtos[] = $produto;
                }
            }

            $content = $this->renderPartial('impressao', [
                'fatura' => $fatura,
                'cliente' => $cliente,
                'perfilCliente' => $perfilCliente,
                'linhasFatura' => $linhasFatura,
                'servicos' => $servicos,
                'receitas' => $receitas,
                'linhasCarrinho' => $linhasCarrinho,
                'produtos' => $produtos,
                'totallinhas' => $totallinhas,
            ]);

        } else {
            $content = $this->renderPartial('impressao', [
                'fatura' => $fatura,
                'cliente' => $cliente,
                'perfilCliente' => $perfilCliente,
                'linhasFatura' => $linhasFatura,
                'servicos' => $servicos,
                'receitas' => $receitas,
                'totallinhas' => $totallinhas,
            ]);
        }
        $content = "<link rel='stylesheet' href='" . Yii::$app->request->baseUrl . "/estilos.css'> <div class='table-container'>" . $content . "</div>";
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($content);
        $mpdf->Output('Fatura ' . $id . '.pdf', 'D');
    }


    /**
     * Finds the Fatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Método que permite encontrar a fatura selecionada
    protected function findModel($id)
    {
        if (($model = Fatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
