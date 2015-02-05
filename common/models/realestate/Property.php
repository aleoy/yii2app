<?php

namespace common\models\realestate;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property integer $id
 * @property integer $addressId
 * @property integer $typeId
 * @property integer $constructionTypeId
 * @property integer $constructionStageId
 * @property integer $sourceId
 * @property string $sourceUrl
 * @property string $dateOnMarket
 * @property string $dateOffMarket
 * @property string $title
 * @property string $description
 * @property integer $floorArea
 * @property integer $floor
 * @property boolean $hasLift
 * @property integer $rooms
 * @property integer $parking
 * @property string $price
 * @property string $otherDetails
 * @property integer $createdBy
 * @property string $createdAt
 * @property integer $updatedBy
 * @property string $updatedAt
 *
 * @property PropertySource $source
 * @property Address $address
 * @property PropertyType $type
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addressId', 'typeId', 'sourceId', 'createdAt', 'title', 'description', 'floorArea', 'rooms'], 'required'],
            [['sourceUrl'], 'unique'],
            ['hasLift', 'boolean'],
            [['addressId', 'typeId', 'constructionTypeId', 'constructionStageId', 'sourceId', 'floorArea', 'onFloor', 'totalFloor', 'rooms', 'parking', 'createdBy', 'updatedBy'], 'integer'],
            [['dateOnMarket', 'dateOffMarket', 'createdAt', 'updatedAt'], 'safe'],
            [['description', 'otherDetails'], 'string'],
            [['price'], 'number'],
            [['sourceUrl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/realestate', 'ID'),
            'addressId' => Yii::t('app/realestate', 'Address ID'),
            'typeId' => Yii::t('app/realestate', 'Type ID'),
            'constructionTypeId' => Yii::t('app/realestate', 'Construction Type ID'),
            'constructionStageId' => Yii::t('app/realestate', 'Construction Stage ID'),
            'sourceId' => Yii::t('app/realestate', 'Source ID'),
            'sourceUrl' => Yii::t('app/realestate', 'Source Url'),
            'dateOnMarket' => Yii::t('app/realestate', 'Date On Market'),
            'dateOffMarket' => Yii::t('app/realestate', 'Date Off Market'),
            'title' => Yii::t('app/realestate', 'Title'),
            'description' => Yii::t('app/realestate', 'Description'),
            'floorArea' => Yii::t('app/realestate', 'Area'),
            'floor' => Yii::t('app/realestate', 'Floor'),
            'hasLift' => Yii::t('app/realestate', 'Has Lift?'),
            'rooms' => Yii::t('app/realestate', 'Rooms'),
            'parking' => Yii::t('app/realestate', 'Parking'),
            'price' => Yii::t('app/realestate', 'Price'),
            'otherDetails' => Yii::t('app/realestate', 'Other Details'),
            'createdBy' => Yii::t('app/realestate', 'Created By'),
            'createdAt' => Yii::t('app/realestate', 'Created At'),
            'updatedBy' => Yii::t('app/realestate', 'Updated By'),
            'updatedAt' => Yii::t('app/realestate', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(PropertySource::className(), ['id' => 'sourceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'addressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PropertyType::className(), ['id' => 'typeId']);
    }
}
