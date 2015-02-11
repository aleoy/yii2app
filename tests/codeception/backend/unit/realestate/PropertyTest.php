<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\backend\unit\DbTestCase;

use common\models\User;
use common\models\realestate\PropertyType;
use common\models\realestate\PropertySource;
use common\models\realestate\ConstructionType;
use common\models\realestate\ConstructionStage;
use common\models\location\Address;
use common\models\realestate\Property;
use common\models\media\Image;

use tests\codeception\common\fixtures\UserFixture;
use tests\codeception\common\fixtures\realestate\PropertySourceFixture;
use tests\codeception\common\fixtures\realestate\PropertyTypeFixture;
use tests\codeception\common\fixtures\realestate\ConstructionTypeFixture;
use tests\codeception\common\fixtures\realestate\ConstructionStageFixture;
use tests\codeception\common\fixtures\location\AddressFixture;
use tests\codeception\common\fixtures\location\CityFixture;
use tests\codeception\common\fixtures\location\DistrictFixture;
use tests\codeception\common\fixtures\realestate\PropertyFixture;
use tests\codeception\common\fixtures\media\ImageFixture;

class PropertyTest extends DbTestCase
{
    use \Codeception\Specify;
    private $_faker;

    protected function setUp()
    {
        // don't forget to call parent method that will setup Yii application
        parent::setUp();

        $this->_faker = \Faker\Factory::create();
    }

    public function testCreate()
    {
        $this->specify("address is required", function() {
            $model = new Property;
            $model->addressId = null;
            $this->assertFalse($model->validate(['addressId']));
        });

        $this->specify("transactionId is required", function() {
            $model = new Property;
            $model->transactionId = null;
            $this->assertFalse($model->validate(['transactionId']));
        });

        $this->specify("type is required", function() {
            $model = new Property;
            $model->typeId = null;
            $this->assertFalse($model->validate(['typeId']));
        });

        $this->specify("createdAt is required", function() {
            $model = new Property;
            $model->createdAt = null;
            $this->assertFalse($model->validate(['createdAt']));
        });

        $this->specify("title is required", function() {
            $model = new Property;
            $model->title = null;
            $this->assertFalse($model->validate(['title']));
        });

        $this->specify("description is required", function() {
            $model = new Property;
            $model->description = null;
            $this->assertFalse($model->validate(['description']));
        });

        $this->specify("floorArea is required", function() {
            $model = new Property;
            $model->floorArea = null;
            $this->assertFalse($model->validate(['floorArea']));
        });

        $this->specify("object is saved", function(){
            $attributes = $this->getNewAttributes();

            $model = new Property;
            $model->attributes = $attributes;
            $model->save();
            $this->assertTrue($model->save());

            $dbModel = Property::findOne(['sourceUrl' => $attributes['sourceUrl']]);
            $this->assertSameModel($dbModel, $attributes);
        });
     }

    public function testCreateImage()
    {
        $this->specify("link image to property", function() {
            $property = $this->properties('apartment central');
            $image = $this->images('img1');
            $property->link('images', $image);
            $property->refresh();
            $this->assertEquals(1, count($property->images));
            $this->assertEquals($property->images[0]->filename, $image->filename);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->properties('apartment central');
            $sourceUrl = 'http://www.majas.lv/apartment/riga/property-11118';
            $this->assertSame($model->sourceUrl, $sourceUrl);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->properties('apartment central');
            $attributes = $this->getNewAttributes();
            $model->attributes = $attributes;
            $model->save();

            $updatedObject = Property::findOne($model->id);
            $this->assertSameModel($updatedObject, $attributes);
        });
    }

    private function assertSameModel($model, $attributes)
    {
        //price precision needs to be verified with delta
        $this->assertEquals($attributes['price'], $model->price, '', 0.001);
        unset($attributes['price']);
        
        //remaining attributes are checked normally
        foreach($attributes as $key => $attribute){
            $this->assertSame($attribute, $model->$key);
        }
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->properties('apartment central');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = Property::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function testCityRelation()
    {
        $this->specify("city relational data", function() {
            $property = $this->properties('apartment central');
            $city = $this->cities('riga');

            $propertyCityName = $property->city->name;
            $cityName = $city->name;
            $this->assertEquals($propertyCityName, $cityName);
        });
    }

    public function testDistrictRelation()
    {
        $this->specify("district relational data", function() {
            $property = $this->properties('apartment central');
            $district = $this->districts('central');

            $propertyDistrictName = $property->district->name;
            $districtName = $district->name;
            $this->assertEquals($propertyDistrictName, $districtName);
        });
    }

    public function testTransactionConstants()
    {
        $this->specify("transaction constants values", function() {
            $this->assertEquals(Property::TRANSACTION_SALE, 1);
            $this->assertEquals(Property::TRANSACTION_RENT, 2);
            $this->assertEquals(Property::TRANSACTION_VACATION_RENTAL, 3);
            $this->assertEquals(Property::TRANSACTION_AUCTION, 4);
            $this->assertEquals(Property::TRANSACTION_EXCHANGE, 5);
        });
    }

    public function testGetTransactions()
    {
        $model = new Property;
        $transactions = [
            Property::TRANSACTION_SALE => \Yii::t('app/realestate/property', 'sale'),
            Property::TRANSACTION_RENT => \Yii::t('app/realestate/property', 'rent'),
            Property::TRANSACTION_VACATION_RENTAL => \Yii::t('app/realestate/property', 'vacation rental'),
            Property::TRANSACTION_AUCTION => \Yii::t('app/realestate/property', 'auction'),
            Property::TRANSACTION_EXCHANGE => \Yii::t('app/realestate/property', 'exchange'),
        ];
        $this->assertEquals($transactions, $model->transactions);
    }

    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php'
            ],
            'addresses' => [
                'class' => AddressFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/address.php'
            ],
            'cities' => [
                'class' => CityFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/city.php'
            ],
            'districts' => [
                'class' => DistrictFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/district.php'
            ],
            'propertySources' => [
                'class' => PropertySourceFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-source.php'
            ],
            'propertyTypes' => [
                'class' => PropertyTypeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-type.php'
            ],
            'constructionTypes' => [
                'class' => ConstructionTypeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/construction-type.php'
            ],
            'constructionStages' => [
                'class' => ConstructionStageFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/construction-stage.php'
            ],
            'properties' => [
                'class' => PropertyFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property.php'
            ],
            'images' => [
                'class' => ImageFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/media/data/image.php'
            ],
        ];
    }

    private function getNewAttributes()
     {
        $faker = $this->_faker;
        $dateOnMarket = $faker->dateTimeThisYear($max = 'now')->format('Y-m-d H:i:s');
        $dateOffMarket = $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s');
        $attributes = [
            'transactionId' => Property::TRANSACTION_SALE,
            'addressId' => $this->addresses('central')->id,
            'typeId' => $this->propertyTypes('apartment')->id,
            'constructionTypeId' => $this->constructionTypes('brick')->id,
            'constructionStageId' => $this->constructionStages('new')->id,
            'sourceId' => $this->propertySources('majas.lv')->id,
            'sourceUrl' => $faker->url,
            'dateOnMarket' => $dateOnMarket,
            'dateOffMarket' => $dateOffMarket,
            'title' => $faker->text(60),
            'description' => $faker->text,
            'floorArea' => 100,
            'onFloor' => 2,
            'totalFloor' => 6,
            'hasLift' => 1,
            'rooms' => $faker->randomDigitNotNull,
            'parking' => null,
            'price' => $faker->randomFloat($nbMaxDecimals = 10, $min = 0, $max = NULL),
            'otherDetails' => $faker->text,
            'createdBy' => $this->users('admin')->id,
            'createdAt' => $dateOnMarket,
            'updatedBy' => $this->users('john')->id,
            'updatedAt' => $dateOffMarket,
        ];

        return $attributes;
     }
}