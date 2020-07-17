<?php

namespace app\controllers\yardin;

use Yii;
use app\models\yardin\UserTasksModel;
use app\models\yardin\UserTasksSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\yardin\UserProjectsModel;

use app\models\yardin\UploadFormModel;
use yii\web\UploadedFile;

/**
 * UserTasksController implements the CRUD actions for UserTasksModel model.
 */
class UserTasksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserTasksModel models.
     * @return mixed
     */
    public function actionIndex($project_id)
    {
        // check if the project is 

        $project = UserProjectsModel::find()
        ->where(['user_id' => Yii::$app->user->id] )
        ->andWhere(['id'=>$project_id])
        ->one();

        if($project_id != $project->id){
            return $this->goBack();
        }


        $searchModel = new UserTasksSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['project_id'=>$project_id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    


    /**
     * Displays a single UserTasksModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTasksModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id)
    {
        $model = new UserTasksModel();

        $model->project_id = $project_id;

        $filemodel = new UploadFormModel();
        // print_r($filemodel);
        // exit;

        if ($model->load(Yii::$app->request->post())) {
          
          

          $filemodel->imageFile = UploadedFile::getInstance($filemodel, 'imageFile');
          $model->task_file = $filemodel->imageFile->name;
            if ($filemodel->imageFile->name) {
              $filemodel->upload();
                // file is uploaded successfully
                
                
               // return;
              }

            if($model->save()){
              return $this->redirect(['view', 'id' => $model->id]);
            }
                    }

        return $this->render('create', [
            'model' => $model,
            'filemodel' => $filemodel
        ]);
    }


    

    /**
     * Deletes an existing UserTasksModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $project_id = $model->project_id;
        $model->delete();

        return $this->redirect(['index', 'project_id' =>$project_id]);
    }

    /**
     * Finds the UserTasksModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTasksModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTasksModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Updates an existing UserTasksModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // echo $model->task_file;

        $filemodel = $this->findFileModel($model->task_file);
          // echo "<pre>";
          // print_r($filemodel);
          // exit;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'filemodel' => $filemodel,
        ]);
    }

    protected function findFileModel($file)
    {
      // $model = UploadFormModel::findFile($file);
      // print_r($model);
      // exit;
      //   return $model;

        if (($model = UploadFormModel::findFile($file)) !== null) {
            return $model;
        }
        $model = new UploadFormModel();
          // print_r($model);
          // exit;
        return $model;

        throw new NotFoundHttpException('The requested page does not exist!!!.');
    }


}
