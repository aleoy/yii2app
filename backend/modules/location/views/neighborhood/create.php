<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\location\Neighborhood */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'Neighborhood',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Neighborhoods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="neighborhood-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cities' => $cities,
        'districts' => $districts,
    ]) ?>

</div>
