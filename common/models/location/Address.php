<?php

namespace common\models\location;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $cityId
 * @property integer $districtId
 * @property integer $neighborhoodId
 * @property string $streetName
 * @property string $streetNumber
 * @property string $buildingNumber
 * @property string $postCode
 * @property string $complement
 * @property double $latitude
 * @property double $longitude
 *
 * @property Neighborhood $neighborhood
 * @property City $city
 * @property District $district
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityId', 'districtId', 'neighborhoodId', 'streetName', 'streetNumber', 'postCode', 'latitude', 'longitude'], 'required'],
            [['cityId', 'districtId', 'neighborhoodId'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['streetName', 'streetNumber', 'buildingNumber', 'postCode', 'complement'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/location', 'ID'),
            'cityId' => Yii::t('app/location', 'City ID'),
            'districtId' => Yii::t('app/location', 'District ID'),
            'neighborhoodId' => Yii::t('app/location', 'Neighborhood ID'),
            'streetName' => Yii::t('app/location', 'Street Name'),
            'streetNumber' => Yii::t('app/location', 'Street Number'),
            'buildingNumber' => Yii::t('app/location', 'Building Number'),
            'postCode' => Yii::t('app/location', 'Post Code'),
            'complement' => Yii::t('app/location', 'Complement'),
            'latitude' => Yii::t('app/location', 'Latitude'),
            'longitude' => Yii::t('app/location', 'Longitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNeighborhood()
    {
        return $this->hasOne(Neighborhood::className(), ['id' => 'neighborhoodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'districtId']);
    }
}
