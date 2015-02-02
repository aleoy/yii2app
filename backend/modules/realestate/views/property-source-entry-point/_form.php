<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\realestate\PropertySourceEntryPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-source-entry-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sourceId')->dropDownList(
            $sources, 
            ['prompt'=>Yii::t('app/realestate', 'Select Source')]
        ); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app/realestate', 'Create') : Yii::t('app/realestate', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
