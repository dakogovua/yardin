<?php

namespace app\controllers\yardin;

use Yii;
use app\models\yardin\UserProjectsModel;
use app\models\yardin\UserProjectsSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\yardin\UserSignupModel;
use app\models\User;

/**
 * UserSignupController implements the CRUD actions for UserProjectsModel model.
 */
class UserSignupController extends Controller
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
     * Lists all UserProjectsModel models.
     * @return mixed
     */
    public function actionIndex()
    {   
        if (Yii::$app->user->isGuest) {
          return $this->redirect(['signup']);
        } 

        $user_id = Yii::$app->user->id;

        $searchModel = new UserProjectsSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['user_id'=>$user_id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSignup(){
      // // print_r($_POST);
      // echo Yii::$app->user->isGuest;
      // exit;
      if (!Yii::$app->user->isGuest) {
          return $this->goHome();
      }
      $model = new UserSignupModel();
      
      if ($model->load(\Yii::$app->request->post()) && $model->validate()){
        $user = new User();
        $user->username = $model->username;
        $user->password = \Yii::$app->security->generatePasswordHash($model->password);
          // print_r($user);
          // exit;
        if ($user->save()){
          return $this->redirect('/site/login');
        }
      }
      
       return $this->render('signup', compact('model'));
      //return $this->goHome();
    }


    /**
     * Displays a single UserProjectsModel model.
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
     * Creates a new UserProjectsModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProjectsModel();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserProjectsModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProjectsModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserProjectsModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProjectsModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProjectsModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
