<?php

namespace tests\codeception\backend\unit\location;

use tests\codeception\backend\unit\DbTestCase;
use common\models\location\City;
use common\models\location\District;
use common\models\location\Neighborhood;
use common\models\location\Address;

use tests\codeception\common\fixtures\location\CityFixture;
use tests\codeception\common\fixtures\location\DistrictFixture;
use tests\codeception\common\fixtures\location\NeighborhoodFixture;
use tests\codeception\common\fixtures\location\AddressFixture;

class AddressTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        //cityId
        $this->specify("city is required", function() {
            $model = new Address;
            $model->cityId = null;
            $this->assertFalse($model->validate(['cityId']));
        });

        //districtId
        $this->specify("district is required", function() {
            $model = new Address;
            $model->districtId = null;
            $this->assertFalse($model->validate(['districtId']));
        });

        //neighborhoodId
        $this->specify("neighborhood is required", function() {
            $model = new Address;
            $model->neighborhoodId = null;
            $this->assertFalse($model->validate(['neighborhoodId']));
        });

        //streetName
        $this->specify("streetName is required", function() {
            $model = new Address;
            $model->streetName = null;
            $this->assertFalse($model->validate(['streetName']));
        });

        //streetNumber
        $this->specify("streetNumber is required", function() {
            $model = new Address;
            $model->streetNumber = null;
            $this->assertFalse($model->validate(['streetNumber']));
        });

        //streetNumber
        $this->specify("streetNumber is required", function() {
            $model = new Address;
            $model->streetNumber = null;
            $this->assertFalse($model->validate(['streetNumber']));
        });

        //latitude
        $this->specify("latitude is required", function() {
            $model = new Address;
            $model->latitude = null;
            $this->assertFalse($model->validate(['latitude']));
        });

        //longitude
        $this->specify("longitude is required", function() {
            $model = new Address;
            $model->longitude = null;
            $this->assertFalse($model->validate(['longitude']));
        });

        $this->specify("object is saved", function() {
            $attributes = [
                'cityId' => $this->cities('riga')->id,
                'districtId' => $this->districts('central')->id,
                'neighborhoodId' => $this->neighborhoods('centrs')->id,
                'streetName' => 'brīvības iela',
                'streetNumber' => '98',
                'buildingNumber' => null,
                'postCode' => 'LV-1011',
                'complement' => 'k2',
                'latitude' => 56.9554,
                'longitude' => 24.1201,
            ];

            $model = new Address;
            $model->attributes = $attributes;
            $model->save();

            $searchAttributes = $attributes;
            unset($searchAttributes['latitude']);
            unset($searchAttributes['longitude']);
            $dbModel = Address::findOne($searchAttributes);

            $dbModelAttributes = $dbModel->attributes;
            unset($dbModelAttributes['id']);
            
            $this->assertEquals($attributes['latitude'], $dbModel->latitude, '', 0.002);
            $this->assertEquals($attributes['longitude'], $dbModel->longitude, '', 0.002);
            unset($dbModelAttributes['latitude']);
            unset($dbModelAttributes['longitude']);
            unset($attributes['latitude']);
            unset($attributes['longitude']);

            $this->assertSame($attributes, $dbModelAttributes);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {

            $searchAttributes = $this->getSearchAttributes();
            $model = Address::findOne($searchAttributes);
            // attributes in search filter were already tested on search 
            // by matching row
            $this->assertEquals($model->latitude, 56.955469, '', 0.002);
            $this->assertEquals($model->longitude, 24.120120, '', 0.002);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {

            $searchAttributes = $this->getSearchAttributes();
            $model = Address::findOne($searchAttributes);

            $updateAttributes = [
                'cityId' => $this->cities('riga')->id,
                'districtId' => $this->districts('central')->id,
                'neighborhoodId' => $this->neighborhoods('centrs')->id,
                'streetName' => 'brīvības gate',
                'streetNumber' => '52',
                'postCode' => 'LV-1021',
                'complement' => null,
            ];
            $model->attributes = $updateAttributes;

            $latitude = 56.123127;
            $model->latitude = $latitude;

            $longitude = 23.231239;
            $model->longitude = $longitude;

            $model->save();

            $model = Address::findOne($updateAttributes);
            // attributes in search filter were already tested on search 
            // by matching row
            $this->assertEquals($model->latitude, $latitude, '', 0.002);
            $this->assertEquals($model->longitude, $longitude, '', 0.002);
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {

            $searchAttributes = $this->getSearchAttributes();
            $model = Address::findOne($searchAttributes);

            $modelId = $model->id;
            $model->delete();

            $deletedObject = Address::findOne($modelId);
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
            'addresses' => [
                'class' => AddressFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/address.php'
            ],
        ];
    }

    private function getSearchAttributes()
    {
        return [
            'cityId' => $this->cities('riga')->id,
            'districtId' => $this->districts('central')->id,
            'neighborhoodId' => $this->neighborhoods('centrs')->id,
            'streetName' => 'brīvības gatave',
            'streetNumber' => '51',
            'postCode' => 'LV-1011',
            'complement' => 'k2',
        ];
    }
}
