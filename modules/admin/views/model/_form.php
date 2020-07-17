<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Bbbmodel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bbbmodel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'marka_id')->textInput() ?>
	
	<?php 
		
		echo $form->field($model, 'marka_id')
		->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Bbbmarka::find()->all(), 'id', 'marka'));
	
	?>

	
    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'body')->textarea(['rows' => 6]) ?>
	
	
	<?php   echo $form->field($model, 'body')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'preset' => 'full',
                'inline' => false,
            ]),
        ]);
		
	?>
	
	

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
