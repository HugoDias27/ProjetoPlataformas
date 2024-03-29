<?php

namespace backend\controllers;

use common\models\Produto;
use common\models\Profile;
use common\models\ReceitaMedica;
use common\models\ReceitaMedicaSearch;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceitaController implements the CRUD actions for ReceitaMedica model.
 */
class ReceitamedicaController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'update'],
                            'allow' => true,
                            'roles' => ['admin', 'funcionario'],
                        ],
                        [
                            'actions' => ['delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],

            ]
        );
    }

    /**
     * Lists all ReceitaMedica models.
     *
     * @return string
     */
    // Método que vai para o index das receitas médicas
    public function actionIndex()
    {
        $searchModel = new ReceitaMedicaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReceitaMedica model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Método que vai para a view de uma receita médica
    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewReceita')) {
            $receita = $this->findModel($id);

            return $this->render('view', [
                'receita' => $receita,
            ]);
        }
        throw new NotFoundHttpException('Não tem permissões para aceder a esta página');

    }

    /**
     * Creates a new ReceitaMedica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // Método que permite criar uma nova receita médica
    public function actionCreate()
    {
        $receita = new ReceitaMedica();

        if (\Yii::$app->user->can('createReceita')) {
            $authManager = Yii::$app->authManager;
            $clienteRole = $authManager->getRole('cliente');

            $clientes = User::find()
                ->innerJoin('auth_assignment', 'auth_assignment.user_id = user.id')
                ->andWhere(['auth_assignment.item_name' => $clienteRole->name])
                ->select(['user.id', 'user.username'])
                ->asArray()
                ->all();

            $clientesItems = ArrayHelper::map($clientes, 'id', 'username');

            $produtos = Produto::find()->where(['prescricao_medica' => 1])->all();
            $produtosItems = ArrayHelper::map($produtos, 'id', 'nome');


            if ($this->request->isPost) {
                if ($receita->load($this->request->post())) {
                    if ($receita->data_validade > date('Y-m-d')) {
                        if ($receita->save()) {
                            return $this->redirect(['view', 'id' => $receita->id]);
                        }
                    } else {
                        $receita->loadDefaultValues();
                    }
                }
            }

            return $this->render('create', [
                'receita' => $receita,
                'clientes' => $clientesItems,
                'produtos' => $produtosItems,
            ]);
        }
        throw new NotFoundHttpException('Não tem permissões para aceder a esta página');
    }


    /**
     * Deletes an existing ReceitaMedica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Método que permite atualizar uma receita médica
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteReceita')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException('Não tem permissões para aceder a esta página');
    }

    /**
     * Finds the ReceitaMedica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ReceitaMedica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    // Método que permite encontrar a receita médica selecionada
    protected function findModel($id)
    {
        if (($receita = ReceitaMedica::findOne(['id' => $id])) !== null) {
            return $receita;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
