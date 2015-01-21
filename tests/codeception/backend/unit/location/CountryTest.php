<?php

namespace tests\codeception\backend\unit\location;

use tests\codeception\frontend\unit\DbTestCase;
use common\models\location\Country as Country;

use tests\codeception\common\fixtures\location\CountryFixture;

class CountryTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $country = new Country;
            $country->name = null;
            $this->assertFalse($country->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $country = new Country();
            $country->name = "russia";
            $country->save();

            $dbCountry = Country::findOne(['name' => 'russia']);
            $this->assertSame($country->name, $dbCountry->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $latvia = $this->countries('latvia');
            $this->assertSame($latvia->name, 'latvia');
        });

        $this->specify("object not found in db", function() {
            $country = Country::findOne(['name' => 'australia']);
            $this->assertNull($country);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $country = $this->countries('latvia');
            $country->name = 'russia';
            $country->save();

            $updatedObject = Country::findOne($country->id);
            $this->assertSame($updatedObject->name, 'russia');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $country = $this->countries('latvia');
            $countryId = $country->id;
            $country->delete();

            $deletedObject = Country::findOne($countryId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'countries' => [
                'class' => CountryFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/country.php'
            ],
        ];
    }
}
