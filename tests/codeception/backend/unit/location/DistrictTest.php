<?php

namespace tests\codeception\backend\unit\location;

use tests\codeception\backend\unit\DbTestCase;
use common\models\location\City;
use common\models\location\District;

use tests\codeception\common\fixtures\location\CityFixture;
use tests\codeception\common\fixtures\location\DistrictFixture;

class DistrictTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $model = new District;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("cityId is required", function() {
            $model = new District;
            $model->cityId = null;
            $this->assertFalse($model->validate(['cityId']));
        });

        $this->specify("cityId is required", function() {
            $model = new District;
            $model->cityId = 9999; //nonexistant valid CityId
            
            $city = City::findOne(['id' => $model->cityId]);
            $this->assertNull($city);

            $this->assertFalse($model->validate(['cityId']));
            $this->assertFalse($model->validate(['cityId']));
        });

        $this->specify("object is saved", function() {
            $model = new District;
            $model->name = "kurzeme";
            $model->cityId = $this->cities('riga')->id;
            $model->save();

            $dbModel = District::findOne(['name' => 'kurzeme']);
            $this->assertSame($model->name, $dbModel->name);
            $this->assertSame($model->cityId, $dbModel->cityId);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = District::findOne(['name' => 'central']);
            $this->assertSame($model->name, 'central');
            $this->assertSame($model->cityId, $this->cities('riga')->id);
        });

        $this->specify("object not found in db", function() {
            $model = District::findOne(['name' => 'madona']);
            $this->assertNull($model);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = District::findOne(['name' => 'central']);
            $model->name = 'latgale';
            $model->cityId = $this->cities('liepaja')->id;
            $model->save();

            $updatedObject = District::findOne($model->id);
            $this->assertSame($updatedObject->name, 'latgale');
            $this->assertSame(
                $updatedObject->cityId, $this->cities('liepaja')->id
            );
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = District::findOne(['name' => 'central']);
            $modelId = $model->id;
            $model->delete();

            $deletedObject = District::findOne($modelId);
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
            'districts' => [
                'class' => DistrictFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/district.php'
            ],
        ];
    }
}
