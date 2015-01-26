<?php

namespace tests\codeception\common\fixtures\location;

use yii\test\ActiveFixture;

/**
 * Country fixture
 */
class DistrictFixture extends ActiveFixture
{
    public $modelClass = 'common\models\location\District';
    public $depends = ['tests\codeception\common\fixtures\location\CityFixture'];
}
