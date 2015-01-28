<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\location\Neighborhood */

$this->title = Yii::t('app/location', 'Update {modelClass}: ', [
    'modelClass' => 'Neighborhood',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Neighborhoods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/location', 'Update');
?>
<div class="neighborhood-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cities' => $cities,
        'districts' => $districts,
    ]) ?>

</div>
