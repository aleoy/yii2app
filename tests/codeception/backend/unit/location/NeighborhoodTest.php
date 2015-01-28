<?php

namespace tests\codeception\backend\unit\location;

use tests\codeception\backend\unit\DbTestCase;
use common\models\location\City;
use common\models\location\District;
use common\models\location\Neighborhood;

use tests\codeception\common\fixtures\location\CityFixture;
use tests\codeception\common\fixtures\location\DistrictFixture;
use tests\codeception\common\fixtures\location\NeighborhoodFixture;

class NeighborhoodTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        //name
        $this->specify("name is required", function() {
            $model = new Neighborhood;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        //cityId
        $this->specify("cityId is required", function() {
            $model = new Neighborhood;
            $model->cityId = null;
            $this->assertFalse($model->validate(['cityId']));
        });

        $this->specify("cityId is exists", function() {
            $model = new Neighborhood;
            $model->cityId = 9999; //nonexistant valid CityId
            $this->assertFalse($model->validate(['cityId']));
        });

        //districtId
        $this->specify("districtId is required", function() {
            $model = new Neighborhood;
            $model->districtId = null;
            $this->assertFalse($model->validate(['districtId']));
        });

        $this->specify("districtId exists", function() {
            $model = new Neighborhood;
            $model->districtId = 999; //nonexistant valid DistrictId
            $this->assertFalse($model->validate(['districtId']));
        });

        $this->specify("object is saved", function() {
            $model = new Neighborhood;
            $model->name = "vecrīga";
            $model->cityId = $this->cities('riga')->id;
            $model->districtId = $this->districts('central')->id;
            $model->save();

            $dbModel = Neighborhood::findOne(['name' => 'vecrīga']);
            $this->assertSame($model->name, $dbModel->name);
            $this->assertSame($model->cityId, $dbModel->cityId);
            $this->assertSame($model->districtId, $dbModel->districtId);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = Neighborhood::findOne(['name' => 'centrs']);
            $this->assertSame($model->name, 'centrs');
            $this->assertSame($model->cityId, $this->cities('riga')->id);
            $this->assertSame($model->districtId, $this->districts('central')->id);
        });

        $this->specify("object not found in db", function() {
            $model = Neighborhood::findOne(['name' => 'madona']);
            $this->assertNull($model);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = Neighborhood::findOne(['name' => 'centrs']);
            $model->name = 'brasa';
            $model->districtId = $this->districts('vidzeme')->id;
            $model->save();

            $updatedObject = Neighborhood::findOne($model->id);
            $this->assertSame($updatedObject->name, 'brasa');
            $this->assertSame(
                $updatedObject->districtId, $this->districts('vidzeme')->id
            );
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = Neighborhood::findOne(['name' => 'centrs']);
            $modelId = $model->id;
            $model->delete();

            $deletedObject = Neighborhood::findOne($modelId);
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
            'neighborhoods' => [
                'class' => NeighborhoodFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/neighborhood.php'
            ],
        ];
    }
}
