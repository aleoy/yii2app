<?php

namespace backend\modules\location\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\location\District;
use common\models\location\City;
use common\models\location\Neighborhood;
use backend\modules\location\models\NeighborhoodSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * NeighborhoodController implements the CRUD actions for Neighborhood model.
 */
class NeighborhoodController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => [],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [], //all actions
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Neighborhood models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NeighborhoodSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Neighborhood model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Neighborhood model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Neighborhood();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cities = $this->getCities();
            $districts = $this->getDistricts();

            return $this->render('create', [
                'model' => $model,
                'cities' => $cities,
                'districts' => $districts,
            ]);
        }
    }

    /**
     * Updates an existing Neighborhood model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $districts = $this->getDistricts();
            $cities = $this->getCities();

            return $this->render('update', [
                'model' => $model,
                'cities' => $cities,
                'districts' => $districts,
            ]);
        }
    }

    /**
     * Deletes an existing Neighborhood model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Neighborhood model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Neighborhood the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Neighborhood::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getCities()
    {
        return ArrayHelper::map(City::find()->all(), 'id', 'name');
    }

    protected function getDistricts()
    {
        return ArrayHelper::map(District::find()->all(), 'id', 'name');
    }
}
