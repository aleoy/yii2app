<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertySource */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'Property Source',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Property Sources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-source-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
