<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\realestate\models\PropertySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/realestate', 'Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/realestate', 'Create {modelClass}', [
    'modelClass' => 'Property',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'addressId',
            'typeId',
            'constructionTypeId',
            'constructionStageId',
            // 'sourceId',
            // 'sourceUrl:url',
            // 'dateOnMarket',
            // 'dateOffMarket',
            // 'title',
            // 'description:ntext',
            // 'rooms',
            // 'parking',
            // 'price',
            // 'otherDetails:ntext',
            // 'createdBy',
            // 'createdAt',
            // 'updatedBy',
            // 'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
