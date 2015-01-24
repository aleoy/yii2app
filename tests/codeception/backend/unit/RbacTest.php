<?php
namespace tests\codeception\backend\unit;

use tests\codeception\backend\unit\DbTestCase;
use yii\rbac\DbManager;
use tests\codeception\common\fixtures\UserFixture;
use tests\codeception\common\fixtures\AuthItemFixture;
use tests\codeception\common\fixtures\AuthRuleFixture;
use tests\codeception\common\fixtures\AuthAssignmentFixture;
use tests\codeception\common\fixtures\AuthItemChildFixture;

class RbacTest extends DbTestCase
{
    use \Codeception\Specify;

    public function testCreate()
    {
        $auth = new DbManager;

        //add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);
        // // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        $admin = $auth->createRole('backendAdmin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // // usually implemented in your User model.
        $userAuthor = $this->users['john'];
        $userAdmin = $this->users['admin'];
        $auth->assign($author, $userAuthor['id']);
        $auth->assign($admin, $userAdmin['id']);

        //sleep(500);
    }

    public function testRead()
    {
        // $this->specify("read object from db", function() {
        //     $admin = User::findOne(['username' => 'admin']);
        //     $this->assertSame($admin->username, 'admin');
        // });

        // $this->specify("object not found in db", function() {
        //     $user = User::findOne(['username' => 'superhiperuser']);
        //     $this->assertNull($user);
        // });
    }

    public function testUpdate()
    {
        // $this->specify("update object from db", function() {
        //     $user = $this->users('admin');
        //     $user->username = 'james';
        //     $user->save();

        //     $updatedObject = User::findOne($user->id);
        //     $this->assertSame($updatedObject->username, 'james');
        // });
    }

    public function testDelete()
    {
        // $this->specify("delete object from db", function() {
        //     $model = $this->users('admin');
        //     $modelId = $model->id;
        //     $model->delete();

        //     $deletedModel = User::findOne($modelId);
        //     $this->assertNull($deletedModel);
        // });
    }

    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php'
            ],
            'authItems' => [
                'class' => AuthItemFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/auth_item.php'
            ],
            'authRules' => [
                'class' => AuthRuleFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/auth_rule.php'
            ],
            'authAssignments' => [
                'class' => AuthAssignmentFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/auth_assignment.php'
            ],
            'authItemChildren' => [
                'class' => AuthItemChildFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/auth_item_child.php'
            ],
        ];
    }
}