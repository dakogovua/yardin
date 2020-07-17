<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserSignupModel */
/* @var $form ActiveForm */
?>
<div class="yardin-user-signup-signup">
    <h1>Придумайте логин и пароль</h1>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?php // $form->field($model, 'role') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- yardin-user-signup-signup -->
