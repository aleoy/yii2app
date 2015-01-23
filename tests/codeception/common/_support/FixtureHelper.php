<?php

namespace tests\codeception\common\_support;

use tests\codeception\common\fixtures\UserFixture;
use tests\codeception\common\fixtures\AuthItemFixture;
use tests\codeception\common\fixtures\AuthRuleFixture;
use tests\codeception\common\fixtures\AuthAssignmentFixture;
use tests\codeception\common\fixtures\AuthItemChildFixture;
use tests\codeception\common\fixtures\location\CountryFixture;
use tests\codeception\common\_pages\LoginPage;
use Codeception\Module;
use yii\test\FixtureTrait;
use common\models\User;
use yii;

/**
 * This helper is used to populate database with needed fixtures before any tests should be run.
 * For example - populate database with demo login user that should be used in acceptance and functional tests.
 * All fixtures will be loaded before suite will be starded and unloaded after it.
 */
class FixtureHelper extends Module
{

    /**
     * Redeclare visibility because codeception includes all public methods that not starts from "_"
     * and not excluded by module settings, in actor class.
     */
    use FixtureTrait {
        loadFixtures as protected;
        fixtures as protected;
        globalFixtures as protected;
        unloadFixtures as protected;
        getFixtures as protected;
        getFixture as protected;
    }

    /**
     * Method called before any suite tests run. Loads User fixture login user
     * to use in acceptance and functional tests.
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $this->loadFixtures();
    }

    /**
     * Method is called after all suite tests run
     */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/data/user.php',
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
            'countries' => [
                'class' => CountryFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/location/data/country.php',
            ],
        ];
    }

    public function amLoggedAs($username, $password = null, $I = null)
    {
        if(null != $I)
            $this->loginAcceptance($username, $password, $I);
        else
            $this->loginFunctional($username);
        /*
        Analysing stack trace is possible to determine wich test is runing.
        This simplistic approach to determine wich kind of test is running is due to the fact that,
        functional tests do not need to know user's password to login.

        codecept_debug(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10));
        [4] => Array
          (
              [file] => /vagrant/yii2app/tests/codeception/backend/acceptance/AcceptanceTester.php
              [line] => 2755
              [function] => runStep
              [class] => Codeception\Scenario
              [type] => ->
          )
        [4] => Array
          (
              [file] => /vagrant/yii2app/tests/codeception/backend/functional/FunctionalTester.php
              [line] => 1960
              [function] => runStep
              [class] => Codeception\Scenario
              [type] => ->
          )
         */
    }

    protected function loginFunctional($username)
    {
        $user = User::findOne(['username' => $username]);
        try{
            Yii::$app->user->login($user, 0);
            $this->assertFalse(Yii::$app->user->isGuest);
        }catch(Exception $e){
            echo 'User not found: '.$e->message;
        }
    }

    protected function loginAcceptance($username, $password, $I)
    {
        $loginPage = LoginPage::openBy($I);

        $I->amGoingTo("login as {$username}");
        $loginPage->login($username, $password, $I);
    }


    public function seeStatusCodeIs($code)
    {
        $status = $this->getModule('PhpBrowser')->session->getStatusCode();

        if(is_array($code)){
            if(!in_array($status,$code)){
                $this->assertEquals(200, $status);
            }
        } else {
            $this->assertEquals($code, $status);
        }
    }
}
