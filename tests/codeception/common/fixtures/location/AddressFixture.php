<?php

namespace tests\codeception\common\fixtures\location;

use yii\test\ActiveFixture;

/**
 * Neighborhood fixture
 */
class AddressFixture extends ActiveFixture
{
    public $modelClass = 'common\models\location\Address';
    public $depends = ['tests\codeception\common\fixtures\location\NeighborhoodFixture'];
}
