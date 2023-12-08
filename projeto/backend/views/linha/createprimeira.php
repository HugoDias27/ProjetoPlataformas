<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LinhaFatura $model */

$this->title = 'Create Linha fatura';
$this->params['breadcrumbs'][] = ['label' => 'Linha Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="linha-fatura-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model, 'modelFatura' => $modelFatura, 'estabelecimento_id' => $estabelecimento_id, 'cliente_id' => $cliente_id,
        ]) ?>

    </div>
