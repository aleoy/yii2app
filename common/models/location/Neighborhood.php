<?php

namespace common\models\location;

use Yii;

/**
 * This is the model class for table "neighborhood".
 *
 * @property integer $id
 * @property integer $cityId
 * @property integer $districtId
 * @property string $name
 *
 * @property District $district
 * @property City $city
 */
class Neighborhood extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'neighborhood';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityId', 'districtId', 'name'], 'required'],
            [['cityId', 'districtId'], 'integer'],
            ['cityId', 'exist', 'targetClass' => City::className(), 'targetAttribute' => 'id'],
            ['districtId', 'exist', 'targetClass' => District::className(), 'targetAttribute' => 'id'],
            [['name'], 'string', 'max' => 255]
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
            'name' => Yii::t('app/location', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'districtId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }
}
