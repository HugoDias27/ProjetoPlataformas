<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var common\models\Profile $modelProfile */

$this->title = 'Criar Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
         'model' => $model, 'modelProfile' => $modelProfile, 'modelSignup' => $modelSignup, 'roleList' => $roleList
    ]) ?>

</div>
