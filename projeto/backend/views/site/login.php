<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Login';

?>
<title><?= Html::encode($this->title) ?></title>
<link href="..\logo.ico" rel="icon">

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username'),'id'=> 'username']) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'),'id' => 'password']) ?>

            <div class="col-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                <?= Html::a('Frontend', Url::to('/projeto/frontend/web/login'), ['class' => 'btn btn-primary btn-block']) ?>
            </div>
    </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
    <!-- /.login-card-body -->
</div>