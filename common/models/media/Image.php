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
    public $allowedExtensions;
    public $minSize;
    public $maxSize;
    public $basedir;

    public function init( )
    {
        parent::init();
        $this->allowedExtensions = ['jpg', 'png', 'gif'];
        $this->minSize = 20000; // bytes      - 20 kb
        $this->maxSize = 2147483647; // bytes - 2147.48 mb
        $this->basedir = \Yii::getAlias('@frontend/web/media/img');
    }

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
            ['size', 'compare', 'compareValue' => $this->minSize, 'operator' => '>='],
            ['size', 'compare', 'compareValue' => $this->maxSize, 'operator' => '<='],
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

    public function download($uri, $basedir = null)
    {
        if(null === $basedir){
            $basedir = $this->basedir;
        }
        $dirname = $this->dirname;
        $basename = $this->getBasename($uri);
        $file = $basedir . '/' . $dirname . '/' . $basename;

        if(!is_dir($basedir . '/' . $dirname))
            mkdir($basedir . '/' . $dirname, 0664, true); //rw-

        file_put_contents($file, fopen($uri, 'r'));

        return $file;
    }

    public function getdirname()
    {
        $dir = date('Y/m/d/H/m');

        return $dir;
    }

    public function getBasename($uri)
    {
        $extension = $this->extensionInfo($uri);
        $basename = md5($uri) . '.' .$extension;

        return $basename;
    }

    public function extensionInfo($file)
    {
        $path_parts = pathinfo($file);
        $extension = strtolower($path_parts['extension']);

        return $extension;
    }

    public function isAllowedExtension($extension)
    {
        if(in_array(strtolower($extension), $this->allowedExtensions)){
            return true;
        } else {
            return false;
        }
    }
    
    public function setFile($file)
    {
        if(!is_file($file)){
            return false;
        }

        list($path, $basename, $extension, $filename) = array_values( pathinfo($file) );
        $this->path = $path;
        $this->extension = $extension;
        $this->filename = $filename;
        $this->size = filesize($file);
        list($this->width, $this->height) = getimagesize($file);

        return true;
    }

    public function getfile()
    {
        return $this->basedir . '/' . $this->path . '/' . $this->filename . '.' . $this->extension;
    }

    public function afterDelete()
    {
        if(is_file($this->file))
            unlink($this->file);

        return parent::afterDelete();
    }
}
