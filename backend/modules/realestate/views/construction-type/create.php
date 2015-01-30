<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\realestate\ConstructionType */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'Construction Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Construction Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="construction-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
