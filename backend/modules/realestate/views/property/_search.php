<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\realestate\models\PropertySearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'addressId') ?>

    <?= $form->field($model, 'typeId') ?>

    <?= $form->field($model, 'constructionTypeId') ?>

    <?= $form->field($model, 'constructionStageId') ?>

    <?php // echo $form->field($model, 'sourceId') ?>

    <?php // echo $form->field($model, 'sourceUrl') ?>

    <?php // echo $form->field($model, 'dateOnMarket') ?>

    <?php // echo $form->field($model, 'dateOffMarket') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'rooms') ?>

    <?php // echo $form->field($model, 'parking') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'otherDetails') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/realestate', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app/realestate', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
