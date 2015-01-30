<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\realestate\ConstructionStage */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'Construction Stage',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Construction Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="construction-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
