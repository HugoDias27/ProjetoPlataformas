<?php

use common\models\Produto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ProdutoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Produto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nome',
            'prescricao_medica',
            'preco',
            'quantidade',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {add-image}',
                'buttons' => [
                    'add-image' => function ($url, $model, $key) {
                        return Html::a(
                            '<icon class="fas fa-solid fa-image"></icon>',
                            Url::to(['imagem/create', 'produto_id' => $model->id]),
                            [
                                'title' => 'Adicionar Imagem',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
