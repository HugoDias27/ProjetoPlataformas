<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Iva $iva */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="iva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($iva, 'percentagem')->dropDownList([0 => '0%', 6 => '6%', 13 => '13%', 23 => '23%']) ?>

    <?= $form->field($iva, 'vigor')->dropDownList([1 => 'Em vigor', 0 => 'Não está em vigor']) ?>

    <?= $form->field($iva, 'descricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
