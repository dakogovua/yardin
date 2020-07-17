<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserProjectsModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-projects-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>
    <? // echo $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id]); ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
