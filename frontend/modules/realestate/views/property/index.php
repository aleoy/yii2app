<?php
use yii\i18n\Formatter;
use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="realestate-default-index">
<?= GridView::widget([
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
    ]); ?>
</div>
