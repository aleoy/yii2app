<?php

namespace tests\codeception\common\fixtures\location;

use yii\test\ActiveFixture;

/**
 * Neighborhood fixture
 */
class NeighborhoodFixture extends ActiveFixture
{
    public $modelClass = 'common\models\location\Neighborhood';
    public $depends = ['tests\codeception\common\fixtures\location\DistrictFixture'];
}
