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
        $this->specify("validate max size", function() {
            $model = new Image;
            $model->size = 2147483648;
            $this->assertFalse($model->validate(['size']));
        });

        //20000 bytes      - 20 kb
        $this->specify("validate min size", function() {
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
            $minSize = $model->minSize;
            $model->attributes = [
                'path' => '2015/02/05/1',
                'filename' => 'winter-house',
                'extension' => 'jpg',
                'size' => $minSize,
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

    public function testInit()
    {
        $this->specify("test initialization", function() {
            $model = new Image;
            
            $allowedExtensions = ['jpg', 'png', 'gif'];
            $this->assertSame($model->allowedExtensions, $allowedExtensions);

            $minSize = 20000; // bytes      - 20 kb
            $this->assertSame($model->minSize, $minSize);

            $maxSize = 2147483647; // bytes - 2147.48 mb
            $this->assertSame($model->maxSize, $maxSize);
        });
    }

    public function testDirname()
    {
        $this->specify("test getdirname", function() {
            $model = new Image;
            
            //test is time bound therefore it should not be run close to the time limit 59s
            //dirname result depends on time
            while(date('s') > 50){
                sleep(1);
            }

            $dirname = date('Y/m/d/H/m');
            $this->assertSame($model->dirname, $dirname);
        });
    }

    public function testExtensionInfo()
    {
        $this->specify("test getextensionInfo", function() {
            $model = new Image;
            $uri = 'https://i.ss.lv/images/2015-02-06/358695/VHgBGkFmRVk=/1-1.th2.jpg';
            $this->assertSame($model->extensionInfo($uri), 'jpg');
        });
    }

    public function testGetBasename()
    {
        $this->specify("test basename", function() {
            $model = new Image;
            $uri = 'https://i.ss.lv/images/2015-02-06/358695/VHgBGkFmRVk=/1-1.th2.jpg';
            $extension = $model->extensionInfo($uri);
            $basename = md5($uri) . '.' . $extension;
            $this->assertSame($model->getBasename($uri), $basename);
        });
    }

    public function testIsAllowedExtension()
    {
        $this->specify("validate allowed extension", function() {
            $model = new Image;
            $this->assertTrue($model->isAllowedExtension('jpg'));
            $this->assertTrue($model->isAllowedExtension('Png'));
            $this->assertTrue($model->isAllowedExtension('GIF'));
        });

        $this->specify("validate NOT allowed extension", function() {
            $model = new Image;
            $this->assertFalse($model->isAllowedExtension('ppt'));
            $this->assertFalse($model->isAllowedExtension('DOCX'));
        });
    }

    public function testDownload()
    {
        $this->specify("test download", function() {
            $model = new Image;
            $uri = 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/PHP_Logo.png/640px-PHP_Logo.png';

            //test is time bound therefore it should not be run close to the time limit 59s
            //dirname result depends on time
            while(date('s') > 50){
                sleep(1);
            }

            $dirname = date('Y/m/d/H/m');

            //saving to custom folder
            $basedir = \Yii::getAlias('@tests/codeception/backend/_output');
            $file = $basedir . '/'. $model->dirname . '/' . $model->getBasename($uri);

            $this->assertEquals($model->download($uri, $basedir), $file);
            $this->assertTrue(is_file($file));
            unlink($file);

            //saving to default folder
            $basedir = \Yii::getAlias('@frontend/web/media/img');
            $file = $basedir . '/'. $model->dirname . '/' . $model->getBasename($uri);

            $this->assertEquals($model->download($uri), $file);
            $this->assertTrue(is_file($file));
            unlink($file);
        });
    }

    public function testSetFile()
    {
        $this->specify("test set file", function() {
            $model = new Image;
            $basedir = \Yii::getAlias('@tests/codeception/common/fixtures/media/data');
            $basename = "3760fa29a9ffec6c6590c06f7b4c7d97";
            $extension = "png";
            $file = $basedir . '/' . $basename . '.' . $extension;

            $model->setFile($file);
            $this->assertEquals($model->filename, $basename);
            $this->assertEquals($model->extension, 'png');
            $this->assertEquals($model->size, '28756');
            $this->assertEquals($model->height, '310');
            $this->assertEquals($model->width, '640');
        });
    }

    public function testGetFile()
    {
        $this->specify("test get file", function() {
            $model = $this->images('img1');
            $file = $model->basedir.'/2015/02/05/1/summer-house.jpg';

            $this->assertEquals($model->file, $file);
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
