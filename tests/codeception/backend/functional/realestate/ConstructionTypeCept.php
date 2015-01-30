<?php 
/*
 * What to Include in your Functional Tests
 * You should test for things such as:
 * - was the web request successful?
 * - was the user redirected to the right page?
 * - was the user successfully authenticated?
 * - was the correct object stored in the response template?
 * - was the appropriate message displayed to the user in the view?
 */
use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\_support\realestate\ConstructionTypeFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure realestate/constructionType page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/realestate/construction-type/index',
  '/realestate/construction-type/create',
  ['/realestate/construction-type/view', 'id'=>'1'],
  ['/realestate/construction-type/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/realestate/construction-type/delete?id=1');
$I->seeRecord('common\models\realestate\ConstructionType', array('id' => 1));

$I->amGoingTo('view construction types');
$I->amLoggedAs('admin');
$I->amOnPage('/realestate/construction-type/index');
$I->see('construction Types','h1');

$I->amGoingTo('create construction type');
$I->amOnPage('/realestate/construction-type/create');
$I->see('Create construction type','h1');

$I->amGoingTo('read construction type');
$I->amOnPage(['/realestate/construction-type/view', 'id'=>'1']);
$I->see('Brick','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update construction type');
$I->amOnPage(['/realestate/construction-type/update', 'id'=>'1']);
$I->see('Update construction type:  Brick', 'h1');
$I->seeInField('ConstructionType[name]', 'brick');