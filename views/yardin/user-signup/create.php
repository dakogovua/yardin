<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\yardin\UserProjectsModel */

$this->title = 'Create User Projects Model';
$this->params['breadcrumbs'][] = ['label' => 'User Projects Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-projects-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
