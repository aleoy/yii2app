<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertyType */

$this->title = Yii::t('app/location', 'Update {modelClass}: ', [
    'modelClass' => 'Property Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Property Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/location', 'Update');
?>
<div class="property-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
