<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($filemodel, 'imageFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>