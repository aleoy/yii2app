<?php

namespace common\models\location;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property integer $cityId
 * @property string $name
 *
 * @property City $city
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityId', 'name'], 'required'],
            [['cityId'], 'integer'],
            ['cityId', 'exist', 'targetClass' => 'common\models\location\City', 'targetAttribute' => 'id'],
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
            'name' => Yii::t('app/location', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }
}
