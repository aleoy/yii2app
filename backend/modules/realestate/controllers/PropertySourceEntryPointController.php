<?php

namespace backend\modules\realestate\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\realestate\PropertySource;
use common\models\realestate\PropertySourceEntryPoint;
use backend\modules\realestate\models\PropertySourceEntryPointSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PropertySourceEntryPointController implements the CRUD actions for PropertySourceEntryPoint model.
 */
class PropertySourceEntryPointController extends Controller
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
     * Lists all PropertySourceEntryPoint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PropertySourceEntryPointSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PropertySourceEntryPoint model.
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
     * Creates a new PropertySourceEntryPoint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PropertySourceEntryPoint();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $sources = $this->getPropertySources();
            return $this->render('create', [
                'model' => $model,
                'sources' => $sources,
            ]);
        }
    }

    /**
     * Updates an existing PropertySourceEntryPoint model.
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
            $sources = $this->getPropertySources();
            return $this->render('update', [
                'model' => $model,
                'sources' => $sources,
            ]);
        }
    }

    /**
     * Deletes an existing PropertySourceEntryPoint model.
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
     * Finds the PropertySourceEntryPoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PropertySourceEntryPoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PropertySourceEntryPoint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getPropertySources()
    {
        return ArrayHelper::map(PropertySource::find()->all(), 'id', 'name');
    }
}
