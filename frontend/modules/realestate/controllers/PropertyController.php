<?php

namespace frontend\modules\realestate\controllers;

use yii\web\Controller;

use Yii;
use common\models\realestate\Property;
use backend\modules\realestate\models\PropertySearchModel;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PropertyController extends Controller
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

    /**
     * Displays a single ConstructionStage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $areaPrice = $model->price / $model->floorArea;
        return $this->render('view', [
            'model' => $model,
            'areaPrice' => $areaPrice,
        ]);
    }

    /**
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
