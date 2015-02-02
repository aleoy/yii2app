<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertySourceEntryPoint */

$this->title = Yii::t('app/realestate', 'Create {modelClass}', [
    'modelClass' => 'Property Source Entry Point',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Property Source Entry Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-source-entry-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sources' => $sources,
    ]) ?>

</div>
