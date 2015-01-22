<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class AuthRuleFixture extends ActiveFixture
{
    public $modelClass = 'tests\codeception\common\fixtures\models\AuthRule';
    public $depends = [
            'tests\codeception\common\fixtures\UserFixture',
            'tests\codeception\common\fixtures\AuthItemFixture',
            'tests\codeception\common\fixtures\AuthItemChildFixture',
           ];
}
