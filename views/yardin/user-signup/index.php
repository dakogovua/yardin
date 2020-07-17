<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\yardin\UserProjectsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Projects Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-projects-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Projects Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'project_name',
            // 'user_id',
            [
              'attribute' =>'project_name',
              'label' => 'Проекты',
              'format' => 'raw',
              'value' => function ($data) {
                return Html::a($data->project_name, ['/yardin/user-tasks', 'project_id' => $data->id], ['class' => 'profile-link']);
                // return Html::url('user-tasks/index', 'project_id'=>$data->id);
              },
           ],
          //  [
          //   'label' => 'Задачи',
          //   'value' => function($data){
          //     echo "<pre>";
          //     print_r($data->tasks);
          //   }
          //  ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
