<?php

namespace tests\codeception\backend\unit\realestate;

use tests\codeception\backend\unit\DbTestCase;
use common\models\realestate\ConstructionStage;

use tests\codeception\common\fixtures\realestate\ConstructionStageFixture;

class ConstructionStageTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("name is required", function() {
            $model = new ConstructionStage;
            $model->name = null;
            $this->assertFalse($model->validate(['name']));
        });

        $this->specify("object is saved", function() {
            $model = new ConstructionStage;
            $model->name = "resale";
            $model->save();

            $dbModel = ConstructionStage::findOne(['name' => 'resale']);
            $this->assertSame($model->name, $dbModel->name);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $model = $this->constructionStages('new');
            $this->assertSame($model->name, 'new');
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $model = $this->constructionStages('new');
            $model->name = 'brand new';
            $model->save();

            $updatedObject = ConstructionStage::findOne($model->id);
            $this->assertSame($updatedObject->name, 'brand new');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->constructionStages('new');
            $modelId = $model->id;
            $model->delete();

            $deletedObject = ConstructionStage::findOne($modelId);
            $this->assertNull($deletedObject);
        });
    }

    public function fixtures()
    {
        return [
            'constructionStages' => [
                'class' => ConstructionStageFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/construction-stage.php'
            ],
        ];
    }
}
