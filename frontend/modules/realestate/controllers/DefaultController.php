<?php

namespace frontend\modules\realestate\controllers;

use yii\web\Controller;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
