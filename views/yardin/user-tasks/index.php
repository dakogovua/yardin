<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\yardin\UserTasksSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Tasks Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-tasks-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <p>
        <?= Html::a('Create User Tasks Model', ['create', 'project_id' =>$_GET['project_id'] ], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task_name',
            'task_status',
          //  'task_file',
            [
              'attribute' => 'task_file',
              'format' => 'raw',
              'value' => function($data){
                // $webroot = \Yii::getAlias('@webroot');
                return Html::a($data->task_file, ['/web/files/'.$data->task_file], ['class' => 'profile-link']);
               // return $data->task_file;
              }

            ],
            'project_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    
</div>
