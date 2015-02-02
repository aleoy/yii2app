<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\realestate\Property */

$this->title = Yii::t('app/realestate', 'Create {modelClass}', [
    'modelClass' => 'Property',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/realestate', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
