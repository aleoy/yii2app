<?php

namespace tests\codeception\backend\unit\media;

use tests\codeception\backend\unit\DbTestCase;
use common\models\media\Image;

use tests\codeception\common\fixtures\media\ImageFixture;

class ImageTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("filename is required", function() {
            $model = new Image;
            $model->filename = null;
            $this->assertFalse($model->validate(['filename']));
        });

        $this->specify("extension is required", function() {
            $model = new Image;
            $model->extension = null;
            $this->assertFalse($model->validate(['extension']));
        });

        $this->specify("path is required", function() {
            $model = new Image;
            $model->path = null;
            $this->assertFalse($model->validate(['path']));
        });

        //2147483647 bytes - 2147.48 mb
        $this->specify("path is required", function() {
            $model = new Image;
            $model->size = 2147483648;
            $this->assertFalse($model->validate(['size']));
        });

        //20000 bytes      - 20 kb
        $this->specify("path is required", function() {
            $model = new Image;
            $model->size = 19999;
            $this->assertFalse($model->validate(['size']));
        });

        $this->specify("object is saved", function() {
            $model = new Image;
            $model->attributes = [
                'path' => '2015/02/05/1',
                'filename' => 'summer-house',
                'extension' => 'jpg',
                'size' => '50000',
                'height' => '400',
                'width' => '800',
            ];
            $model->save();

            $dbModel = Image::findOne([
                'filename' => 'summer-house',
                'path' => '2015/02/05/1',
            ]);

            $this->assertSame($model->filename, $dbModel->filename);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->images('img1');
            $this->assertSame($model->filename, 'summer-house');
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->images('img1');
            $model->attributes = [
                'path' => '2015/02/05/1',
                'filename' => 'winter-house',
                'extension' => 'jpg',
                'size' => '600',
                'height' => '100',
                'width' => '200',
            ];
            $model->save();

            $updatedObject = Image::findOne($model->id);
            $this->assertSame($updatedObject->filename, 'winter-house');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->images('img1');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = Image::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'images' => [
                'class' => ImageFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/media/data/image.php'
            ],
        ];
    }
}
