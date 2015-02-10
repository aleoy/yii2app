<?php

namespace frontend\modules\realestate\controllers;

use yii\web\Controller;

use Yii;
use common\models\realestate\Property;
use backend\modules\realestate\models\PropertySearchModel;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PropertySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
