<?php

namespace common\models\media;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $path
 * @property string $filename
 * @property string $extension
 * @property integer $size
 * @property integer $height
 * @property integer $width
 *
 * @property PropertyImage[] $propertyImages
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'filename', 'extension'], 'required'],
            [['size', 'height', 'width'], 'integer'],
            [['path', 'filename', 'extension'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/media/image', 'ID'),
            'path' => Yii::t('app/media/image', 'Path'),
            'filename' => Yii::t('app/media/image', 'Filename'),
            'extension' => Yii::t('app/media/image', 'Extension'),
            'size' => Yii::t('app/media/image', 'Size'),
            'height' => Yii::t('app/media/image', 'Height'),
            'width' => Yii::t('app/media/image', 'Width'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyImages()
    {
        return $this->hasMany(PropertyImage::className(), ['imageId' => 'id']);
    }
}
