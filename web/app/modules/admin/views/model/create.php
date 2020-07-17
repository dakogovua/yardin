<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bbbmodel */

$this->title = 'Create Bbbmodel';
$this->params['breadcrumbs'][] = ['label' => 'Bbbmodels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bbbmodel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
