<?php

namespace common\models\realestate;

use Yii;

/**
 * This is the model class for table "property_type".
 *
 * @property integer $id
 * @property string $name
 */
class PropertyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/realestate', 'ID'),
            'name' => Yii::t('app/realestate', 'Name'),
        ];
    }
}
