<?php

namespace common\models\realestate;

use Yii;

/**
 * This is the model class for table "property_source".
 *
 * @property integer $id
 * @property string $name
 */
class PropertySource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
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
