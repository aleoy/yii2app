<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertySourceEntryPoint */

$this->title = Yii::t('app/realestate', 'Update {modelClass}: ', [
    'modelClass' => 'Property Source Entry Point',
]) . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Property Source Entry Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/realestate', 'Update');
?>
<div class="property-source-entry-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sources' => $sources,
    ]) ?>

</div>
