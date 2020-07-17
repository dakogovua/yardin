<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserTasksModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-tasks-model-form">

<?php $form = ActiveForm::begin([
  'id' => 'aaa',
  'options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'task_name')->textInput(['maxlength' => true]) ?>

<? // $form->field($model, 'task_status')->textInput(['maxlength' => true]) ?>
<?php echo  $form->field($model, 'task_status')->dropDownList([ 'New' => 'New', 'In progress' => 'In progress',
'Done' => 'Done']) ?>

<?php // $form->field($model, 'task_file')->textInput(['maxlength' => true]) ?>

<?php // echo $form->field($filemodel, 'imageFile')->fileInput() ?>

<?= $form->field($filemodel, 'imageFile')->fileInput() ?>

<? // echo $form->field($model, 'project_id')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
