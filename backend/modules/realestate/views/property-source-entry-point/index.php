<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\realestate\models\PropertySourceEntryPointSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/realestate', 'Property Source Entry Points');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-source-entry-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/realestate', 'Create {modelClass}', [
    'modelClass' => 'Property Source Entry Point',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sourceId',
            'statusId',
            'description',
            'startedAt',
            'finishedAt',
            // 'url:url',
            // 'currentPage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
