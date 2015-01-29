<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\frontend\unit\DbTestCase;
use common\models\realestate\PropertyType;

use tests\codeception\common\fixtures\realestate\PropertyTypeFixture;

class PropertyTypeTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $model = new PropertyType;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $model = new PropertyType;
            $model->name = "flat";
            $model->save();

            $dbModel = PropertyType::findOne(['name' => 'flat']);
            $this->assertSame($model->name, $dbModel->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->propertyTypes('apartment');
            $this->assertSame($model->name, 'apartment');
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->propertyTypes('apartment');
            $model->name = 'apartmentas';
            $model->save();

            $updatedObject = PropertyType::findOne($model->id);
            $this->assertSame($updatedObject->name, 'apartmentas');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->propertyTypes('apartment');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = PropertyType::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'propertyTypes' => [
                'class' => PropertyTypeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-type.php'
            ],
        ];
    }
}
