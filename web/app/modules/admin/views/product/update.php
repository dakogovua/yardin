<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bbbmarka */

$this->title = 'Update Bbbmarka: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bbbmarkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bbbmarka-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
