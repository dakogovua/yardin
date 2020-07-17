<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserProjectsModel */

$this->title = 'Update User Projects Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Projects Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-projects-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
