<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\Property */

$this->title = Yii::t('app/realestate', 'Update {modelClass}: ', [
    'modelClass' => 'Property',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/realestate', 'Update');
?>
<div class="property-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
