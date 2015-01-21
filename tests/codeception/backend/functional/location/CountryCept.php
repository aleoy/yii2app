<?php 
use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\fixtures\UserFixture;
use common\models\User as User;

$I = new FunctionalTester($scenario);
$I->wantTo('create user');
$I->amLoggedAs('john');
//$I->amLoggedAs($savedUser);
// $I->see('Welcome, John');
