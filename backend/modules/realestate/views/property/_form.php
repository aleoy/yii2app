<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\Property */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'addressId')->textInput() ?>

    <?= $form->field($model, 'typeId')->textInput() ?>

    <?= $form->field($model, 'constructionTypeId')->textInput() ?>

    <?= $form->field($model, 'constructionStageId')->textInput() ?>

    <?= $form->field($model, 'sourceId')->textInput() ?>

    <?= $form->field($model, 'sourceUrl')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'dateOnMarket')->textInput() ?>

    <?= $form->field($model, 'dateOffMarket')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rooms')->textInput() ?>

    <?= $form->field($model, 'parking')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'otherDetails')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <?= $form->field($model, 'updatedAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/realestate', 'Create') : Yii::t('app/realestate', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
