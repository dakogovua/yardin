<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserTasksModel */

$this->title = 'Update User Tasks Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Tasks Models', 'url' => ['index', 'project_id' => $model->project_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-tasks-model-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
      // echo "<pre>";
      // print_r($filemodel);
      // exit;
    ?>
    <?= $this->render('_form', [
        'model' => $model,
        'filemodel' => $filemodel,
    ]) ?>

</div>
