<?php

namespace common\models\realestate;

use Yii;
use common\models\location\District;
use common\models\location\City;
use common\models\location\Address;
use common\models\realestate\ConstructionType;
use common\models\realestate\ConstructionStage;
use common\models\media\Image;
/**
 * This is the model class for table "property".
 *
 * @property integer $id
 * @property integer $transationId
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
    const TRANSACTION_SALE = 1;
    const TRANSACTION_RENT = 2;
    const TRANSACTION_VACATION_RENTAL = 3;
    const TRANSACTION_AUCTION = 4;
    const TRANSACTION_EXCHANGE = 5;

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
            [['transactionId', 'addressId', 'typeId', 'sourceId', 'createdAt', 'title', 'description', 'floorArea', 'rooms'], 'required'],
            ['transactionId', 'in', 'range' => array_keys($this->transactions)],
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
            'transactionId' => Yii::t('app/realestate/property', 'Transaction'),
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
    public function getConstructionType()
    {
        return $this->hasOne(ConstructionType::className(), ['id' => 'constructionTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConstructionStage()
    {
        return $this->hasOne(ConstructionStage::className(), ['id' => 'constructionStageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'addressId']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId'])
            ->via('address');
    }

    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'districtId'])
            ->via('address');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PropertyType::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'imageId'])
            ->viaTable('property_image', ['propertyId' => 'id']);
    }

    public static function getTransactions()
    {
        return [
            self::TRANSACTION_SALE => \Yii::t('app/realestate/property', 'sale'),
            self::TRANSACTION_RENT => \Yii::t('app/realestate/property', 'rent'),
            self::TRANSACTION_VACATION_RENTAL => \Yii::t('app/realestate/property', 'vacation rental'),
            self::TRANSACTION_AUCTION => \Yii::t('app/realestate/property', 'auction'),
            self::TRANSACTION_EXCHANGE => \Yii::t('app/realestate/property', 'exchange'),
        ];
    }

    public function getMeterPrice()
    {
        return round($this->price / $this->floorArea, 0);
    }

    public function getFeaturedImage()
    {
        if (isset($this->images[0])) {
            return $this->images[0]->uri;
        } else {
            return '';
        }
    }
}
