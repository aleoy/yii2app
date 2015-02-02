<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertySourceEntryPoint */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Property Source Entry Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-source-entry-point-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/realestate', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/realestate', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/realestate', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sourceId',
            'statusId',
            'startedAt',
            'finishedAt',
            'url:url',
            'currentPage',
            'description',
        ],
    ]) ?>

</div>
