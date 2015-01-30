<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\ConstructionType */

$this->title = Yii::t('app/location', 'Update {modelClass}: ', [
    'modelClass' => 'Construction Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Construction Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/location', 'Update');
?>
<div class="construction-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
