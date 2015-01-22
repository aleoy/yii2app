<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * User fixture
 */
class AuthAssignmentFixture extends ActiveFixture
{
    public $modelClass = 'tests\codeception\common\fixtures\models\AuthAssignment';
    public $depends = [
            'tests\codeception\common\fixtures\UserFixture',
            'tests\codeception\common\fixtures\AuthItemFixture',
           ];
}
