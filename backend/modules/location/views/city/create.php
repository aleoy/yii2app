<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\location\City */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'City',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
