<?php

namespace tests\codeception\common\fixtures\realestate;

use yii\test\ActiveFixture;

/**
 * Country fixture
 */
class PropertyFixture extends ActiveFixture
{
    public $modelClass = 'common\models\realestate\Property';
    public $depends = [
      'tests\codeception\common\fixtures\UserFixture',
      'tests\codeception\common\fixtures\location\AddressFixture',
      'tests\codeception\common\fixtures\realestate\ConstructionStageFixture',
      'tests\codeception\common\fixtures\realestate\ConstructionTypeFixture',
      'tests\codeception\common\fixtures\realestate\PropertySourceFixture',
      'tests\codeception\common\fixtures\realestate\PropertyTypeFixture',
    ];
}
