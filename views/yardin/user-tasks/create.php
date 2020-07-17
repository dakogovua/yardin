<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserTasksModel */

$this->title = 'Create User Tasks Model';
$this->params['breadcrumbs'][] = ['label' => 'User Tasks Models', 'url' => ['index', 'project_id' => $_GET['project_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-tasks-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'filemodel' => $filemodel,
    ]) ?>

</div>
