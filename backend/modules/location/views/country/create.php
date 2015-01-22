<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\location\Country */

$this->title = Yii::t('app/location', 'Create {modelClass}', [
    'modelClass' => 'Country',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/location', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
