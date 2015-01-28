<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\location\Neighborhood */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="neighborhood-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cityId')->dropDownList(
            $cities, 
            ['prompt'=>Yii::t('app/location', 'Select City')]
        ); ?>

    <?= $form->field($model, 'districtId')->dropDownList(
            $districts, 
            ['prompt'=>Yii::t('app/location', 'Select District')]
        ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/location', 'Create') : Yii::t('app/location', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
