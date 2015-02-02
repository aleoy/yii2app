<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\realestate\models\PropertySourceEntryPointSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-source-entry-point-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sourceId') ?>

    <?= $form->field($model, 'statusId') ?>

    <?= $form->field($model, 'startedAt') ?>

    <?= $form->field($model, 'finishedAt') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'currentPage') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/realestate', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/realestate', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
