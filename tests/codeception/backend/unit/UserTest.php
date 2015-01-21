<?php

namespace tests\codeception\backend\unit;

use tests\codeception\backend\unit\DbTestCase;
use common\models\User as User;

use tests\codeception\common\fixtures\UserFixture;

class UserTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $this->specify("username is required", function() {
            $user = new User;
            $user->username = null;
            $this->assertFalse($user->validate(['username']));
        });

        $this->specify("username is unique", function() {
            $user = new User;
            $user->username = 'admin';
            $this->assertFalse($user->validate(['username']));
        });

        $this->specify("object is saved", function() {
            $user = new User;
            $user->username = "ronaldo";
            $this->assertTrue($user->save());

            $dbUser = User::findOne(['username' => 'ronaldo']);
            $this->assertSame($user->username, $dbUser->username);
        });
    }

    public function testRead()
    {
        $this->specify("read object from db", function() {
            $admin = User::findOne(['username' => 'admin']);
            $this->assertSame($admin->username, 'admin');
        });

        $this->specify("object not found in db", function() {
            $user = User::findOne(['username' => 'superhiperuser']);
            $this->assertNull($user);
        });
    }

    public function testUpdate()
    {
        $this->specify("update object from db", function() {
            $user = $this->users('admin');
            $user->username = 'james';
            $user->save();

            $updatedObject = User::findOne($user->id);
            $this->assertSame($updatedObject->username, 'james');
        });
    }

    public function testDelete()
    {
        $this->specify("delete object from db", function() {
            $model = $this->users('admin');
            $modelId = $model->id;
            $model->delete();

            $deletedModel = User::findOne($modelId);
            $this->assertNull($deletedModel);
        });
    }

    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php'
            ],
        ];
    }
}
