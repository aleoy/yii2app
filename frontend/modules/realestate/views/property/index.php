<?php
use yii\i18n\Formatter;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\location\District;
use common\models\realestate\Property;
?>
<div class="realestate-default-index">
<div>
    <h1>filters</h1>
    <div class="property-type-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-4">
            <?php
                $transactionsListData = Property::getTransactions();
                echo $form->field($searchModel, 'transactionId')->dropDownList(
                    $transactionsListData,
                    ['prompt'=>'Select...']);
            ?>
        </div>

        <div class="col-md-4">
            <?php
                $districts = District::find()->all();
                $listData=ArrayHelper::map($districts,'id','name');
                echo $form->field($searchModel, 'districtId')->dropDownList(
                    $listData,
                    ['prompt'=>'Select...']);
            ?>
        </div>

        <div class="col-md-4">
            <?php
                echo $form->field($searchModel, 'roomsMin')->dropDownList(
                    array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4+',
                    ),
                    ['prompt'=>'Select...']);
            ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($searchModel, 'priceMin')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($searchModel, 'priceMax')->textInput() ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php
    echo \yii\widgets\LinkPager::widget([
        'pagination'=>$dataProvider->pagination,
    ]);
?>
<style>
    table tbody tr td{
        padding: 5px;
    }
    table tbody tr:nth-child(2n+1){
        background-color: #eee;
    }
    .thumb{
        width:100%;
    }
</style>
<div>
    <h1>results</h1>
    <table>
        <tbody>
            <tr>
                <td class="col-md-2"></td>
                <td class="col-md-1 text-center">price</td>
                <td class="col-md-1 text-center">rooms</td>
                <td class="col-md-1 text-center">district</td>
                <td class="col-md-1 text-center">floor</td>
                <td class="col-md-1 text-center">streetname</td>
                <td class="col-md-1 text-center">floor area</td>
                <td class="col-md-1 text-center">price / m2</td>
                <td class="col-md-1 text-center">created at</td>
            </tr>
    <?php
    foreach ($models as $model) {
    ?>
    <tr>
                <td><img class="thumb" src="<?= $model->featuredImage; ?>"></td>
                <td class="price text-right"><?= number_format($model->price, 0, '', '.'); ?></td>
                <td class="text-center"><?= $model->rooms ?></td>
                <td><?= $model->district->name ?></td>
                <td class="text-center"><?= $model->onFloor ?></td>
                <td><?= $model->address->streetName ?></td>
                <td class="text-right"><?= $model->floorArea ?></td>
                <td class="text-right"><?= number_format($model->meterPrice, 0, '', '.'); ?></td>
                <td class="text-right"><?= $model->createdAt; ?></td>
            </tr>
    <?php
}
    ?>
    </tbody>
    </table>
</div>
<?php

/* 
GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // [
            //     'attribute' => 'city',
            //     'value' => 'city.name',
            // ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    if(isset($data->images[0]))
                        return Html::img($data->images[0]->uri, ['width'=>'100']);
                    else
                        return null;
                },
            ],
            [
                'attribute' => 'district',
                'value' => 'district.name',
            ],
            [
                'attribute' => 'type',
                'value' => 'type.name',
            ],
            [
                'attribute' => 'address',
                'value' => 'address.streetName',
            ],
            'floorArea',
            'onFloor',
            // 'constructionStageId',
            // 'sourceId',
            // 'sourceUrl:url',
            // 'dateOnMarket',
            // 'dateOffMarket',
            // 'title',
            'rooms',
            // 'parking',
            [
                'attribute' => 'price',
                'format' => ['decimal'],
                // 'value' => function ($data) {
                //     return \yii\i18n\Formatter::asDecimal($data->price);
                // },
            ],
            // 'otherDetails:ntext',
            // 'createdBy',
            // 'createdAt',
            // 'updatedBy',
            // 'updatedAt',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]);
*/
     ?>
</div>
