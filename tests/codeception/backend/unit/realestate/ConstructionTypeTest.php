<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\backend\unit\DbTestCase;
use common\models\realestate\ConstructionType;

use tests\codeception\common\fixtures\realestate\ConstructionTypeFixture;

class ConstructionTypeTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $model = new ConstructionType;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $model = new ConstructionType;
            $model->name = "wood";
            $model->save();

            $dbModel = ConstructionType::findOne(['name' => 'wood']);
            $this->assertSame($model->name, $dbModel->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->constructionTypes('brick');
            $this->assertSame($model->name, 'brick');
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->constructionTypes('brick');
            $model->name = 'brickzila';
            $model->save();

            $updatedObject = ConstructionType::findOne($model->id);
            $this->assertSame($updatedObject->name, 'brickzila');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->constructionTypes('brick');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = ConstructionType::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'constructionTypes' => [
                'class' => ConstructionTypeFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/construction-type.php'
            ],
        ];
    }
}
