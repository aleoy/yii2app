<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\location\Neighborhood */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Neighborhoods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="neighborhood-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/location', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/location', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/location', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cityId',
            'districtId',
            'name',
        ],
    ]) ?>

</div>
