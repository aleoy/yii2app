<?php

namespace common\models\realestate;

use Yii;

/**
 * This is the model class for table "property_source_entry_point".
 *
 * @property integer $id
 * @property integer $sourceId
 * @property integer $statusId
 * @property string $startedAt
 * @property string $finishedAt
 * @property string $url
 * @property integer $currentPage
 * @property string $description
 *
 * @property PropertySource $source
 */
class PropertySourceEntryPoint extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_source_entry_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceId', 'url'], 'required'],
            ['statusId', 'default', 'value' => self::STATUS_INACTIVE, 'on' => ['create']],
            ['statusId', 'required', 'except' => ['create']],
            ['statusId', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['sourceId', 'statusId', 'currentPage'], 'integer'],
            [['startedAt', 'finishedAt'], 'safe'],
            [['url', 'description'], 'string', 'max' => 255],
            ['url', 'url', 'defaultScheme' => 'http'],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/realestate', 'ID'),
            'sourceId' => Yii::t('app/realestate', 'Source ID'),
            'statusId' => Yii::t('app/realestate', 'Status ID'),
            'startedAt' => Yii::t('app/realestate', 'Started At'),
            'finishedAt' => Yii::t('app/realestate', 'Finished At'),
            'url' => Yii::t('app/realestate', 'Url'),
            'currentPage' => Yii::t('app/realestate', 'Current Page'),
            'description' => Yii::t('app/realestate', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(PropertySource::className(), ['id' => 'sourceId']);
    }

    public function getStatuses()
    {
        return [
            'active' => STATUS_ACTIVE,
            'inactive' => STATUS_INACTIVE,
        ];
    }
}
