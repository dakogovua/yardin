<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bbbmodels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bbbmodel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bbbmodel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'model',
            //'marka_id',
			[
				'attribute' => 'marka_id',
				'value' => function($data){
					return $data->marka->marka;
				},
			],
		
            'price',
            'title',
            //'description',
            //'keywords',
            //'body:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
