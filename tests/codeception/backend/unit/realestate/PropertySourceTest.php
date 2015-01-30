<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\backend\unit\DbTestCase;
use common\models\realestate\PropertySource;

use tests\codeception\common\fixtures\realestate\PropertySourceFixture;

class PropertySourceTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $model = new PropertySource;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("unique validation", function() {
            $model = new PropertySource;
            $model->name = $this->propertySources('majas.lv')->name;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $model = new PropertySource;
            $model->name = "domio.com";
            $model->save();

            $dbModel = PropertySource::findOne(['name' => 'domio.com']);
            $this->assertSame($model->name, $dbModel->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->propertySources('majas.lv');
            $this->assertSame($model->name, 'majas.lv');
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->propertySources('majas.lv');
            $model->name = 'dzivokli.lv';
            $model->save();

            $updatedObject = PropertySource::findOne($model->id);
            $this->assertSame($updatedObject->name, 'dzivokli.lv');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->propertySources('majas.lv');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = PropertySource::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'propertySources' => [
                'class' => PropertySourceFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-source.php'
            ],
        ];
    }
}
