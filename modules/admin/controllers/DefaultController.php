<?php

namespace app\modules\admin\controllers;

// use yii\web\Controller;
use app\modules\admin\controllers\AdminController;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
