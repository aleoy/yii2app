<?php

namespace tests\codeception\backend\unit\location;

use tests\codeception\frontend\unit\DbTestCase;
use common\models\location\City;

use tests\codeception\common\fixtures\location\CityFixture;

class CityTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $city = new City;
            $city->name = null;
            $this->assertFalse($city->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $city = new City;
            $city->name = "jelgava";
            $city->save();

            $dbModel = City::findOne(['name' => 'jelgava']);
            $this->assertSame($city->name, $dbModel->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->cities('riga');
            $this->assertSame($model->name, 'riga');
        });

        $this->specify("object not found in db", function() {
            $model = City::findOne(['name' => 'madona']);
            $this->assertNull($model);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->cities('riga');
            $model->name = 'jurmala';
            $model->save();

            $updatedObject = City::findOne($model->id);
            $this->assertSame($updatedObject->name, 'jurmala');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->cities('riga');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = City::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'cities' => [
                'class' => CityFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/city.php'
            ],
        ];
    }
}
