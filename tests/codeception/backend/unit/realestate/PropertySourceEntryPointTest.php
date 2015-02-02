<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\backend\unit\DbTestCase;
use common\models\realestate\PropertySource;
use common\models\realestate\PropertySourceEntryPoint;

use tests\codeception\common\fixtures\realestate\PropertySourceFixture;
use tests\codeception\common\fixtures\realestate\PropertySourceEntryPointFixture;

class PropertySourceEntryPointTest extends DbTestCase
{
    use \Codeception\Specify;
    private $_faker;

    protected function setUp()
    {
        // don't forget to call parent method that will setup Yii application
        parent::setUp();

        $this->_faker = \Faker\Factory::create();
    }

    public function testValidate()
    {
        $this->specify("sourceId is required", function() {
            $model = new PropertySourceEntryPoint;
            $model->sourceId = null;
            $this->assertFalse($model->validate(['sourceId']));
        });

        $this->specify("url is required", function() {
            $model = new PropertySourceEntryPoint;
            $model->url = null;
            $this->assertFalse($model->validate(['url']));
        });

        $this->specify("unique validation", function() {
            $model = new PropertySourceEntryPoint;
            $model->url = $this->entryPoints('ss riga apartments')->url;
            $this->assertFalse($model->validate(['url']));
        });

        $this->specify("url validation", function() {
            $model = new PropertySourceEntryPoint;
            $model->url = 'conan the barbarian';
            $this->assertFalse($model->validate(['url']));
        });
    }

    public function testCreate()
    {
        $faker = $this->_faker;
        $this->specify("object is saved", function() use($faker){
            $model = new PropertySourceEntryPoint;
            $startedAt = $faker->dateTimeThisYear($max = 'now')->format('Y-m-d H:i:s');
            $finishedAt = $faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s');
            $sourceId = $this->propertySources('ss.lv')->id;
            $statusId = PropertySourceEntryPoint::STATUS_INACTIVE;
            $url = $faker->url;

            $attributes = [
                'sourceId' => $sourceId,
                'statusId' => $statusId,
                'startedAt' => $startedAt,
                'finishedAt' => $finishedAt,
                'url' => $url,
                'currentPage' => null,
                'description' => $faker->text(250),
            ];
            $model->attributes = $attributes;
            $this->assertTrue($model->save());

            $dbModel = PropertySourceEntryPoint::findOne(['url' => $url]);
            $this->assertSame($model->attributes, $dbModel->attributes);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->entryPoints('ss riga apartments');
            $attributes = [
                'sourceId' => $this->propertySources('ss.lv')->id,
                'statusId' => PropertySourceEntryPoint::STATUS_ACTIVE,
                'startedAt' => null,
                'finishedAt' => null,
                'url' => 'https://www.ss.lv/lv/real-estate/flats/riga/all/',
                'currentPage' => null,
                'description' => 'listing of all apartments in riga'
            ];
            $modelAttributes = $model->attributes;
            unset($modelAttributes['id']);
            $this->assertSame($modelAttributes, $attributes);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->entryPoints('ss riga apartments');
            $startedAt = $this->_faker->dateTimeThisYear($max = 'now')->format('Y-m-d H:i:s');
            $finishedAt = $this->_faker->dateTimeThisMonth($max = 'now')->format('Y-m-d H:i:s');
            $attributes = [
                'sourceId' => $this->propertySources('majas.lv')->id,
                'statusId' => PropertySourceEntryPoint::STATUS_INACTIVE,
                'startedAt' => $startedAt,
                'finishedAt' => $finishedAt,
                'url' => $this->_faker->url,
                'currentPage' => 2,
                'description' => 'listing of all auctions in riga'
            ];
            $model->attributes = $attributes;
            $this->assertTrue($model->save());

            $updatedObject = PropertySourceEntryPoint::findOne($model->id);
            $updatedAttributes = $updatedObject->attributes;
            unset($updatedAttributes['id']);
            $this->assertSame($updatedAttributes, $attributes);
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->entryPoints('ss riga apartments');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = PropertySourceEntryPoint::findOne($modelId);
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
            'entryPoints' => [
                'class' => PropertySourceEntryPointFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-source-entry-point.php'
            ],
        ];
    }
}
