<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\Property */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="construction-stage-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'city',
                'value' => $model->city->name,
            ],
            [
                'attribute' => 'district',
                'value' => $model->district->name,
            ],
            [
                'attribute' => 'address',
                'value' => $model->address->streetName . ', ' . $model->address->streetNumber,
            ],
            'rooms',
            'floorArea',
            'onFloor',
            'totalFloor',
            'hasLift',
            [
                'attribute' => 'constructionType',
                'value' => isset($model->constructionType) ? $model->constructionType->name : '',
            ],
            [
                'attribute' => 'constructionStage',
                'value' => isset($model->constructionStage) ? $model->constructionStage->name : '',
            ],
            [
                'attribute' => 'price',
                'value' => Yii::$app->formatter->asDecimal($model->price) . ' (' . Yii::$app->formatter->asDecimal($areaPrice, 0) . ' /m²)',
            ],
            'description',
        ],
    ]) ?>
</div>
<?php 
foreach ($model->images as $image) {
    echo Html::img($image->uri, ['width'=>'300']);
    //echo Html::tag('br');
}
?>
<p>latitude: <?= $model->address->latitude ?></p>
<p>longitude: <?= $model->address->longitude ?></p>
<div id="gmap0-map-canvas" style="width:500px;height:500px">
    <?php $this->render('_map', ['address' => $model->address]); ?>
</div>