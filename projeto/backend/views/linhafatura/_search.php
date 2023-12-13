<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LinhaFaturaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="linha-fatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dta_venda') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'precounit') ?>

    <?= $form->field($model, 'valoriva') ?>

    <?php // echo $form->field($model, 'valorcomiva') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'fatura_id') ?>

    <?php // echo $form->field($model, 'receita_medica_id') ?>

    <?php // echo $form->field($model, 'servico_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
