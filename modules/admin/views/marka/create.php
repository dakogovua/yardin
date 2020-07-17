<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bbbmarka */

$this->title = 'Create Bbbmarka';
$this->params['breadcrumbs'][] = ['label' => 'Bbbmarkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bbbmarka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
