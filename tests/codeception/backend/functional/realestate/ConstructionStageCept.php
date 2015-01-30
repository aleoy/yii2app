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
use tests\codeception\common\_support\realestate\ConstructionStageFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure realestate/constructionStage page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/realestate/construction-stage/index',
  '/realestate/construction-stage/create',
  ['/realestate/construction-stage/view', 'id'=>'1'],
  ['/realestate/construction-stage/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/realestate/construction-stage/delete?id=1');
$I->seeRecord('common\models\realestate\ConstructionStage', array('id' => 1));

$I->amGoingTo('view construction stages');
$I->amLoggedAs('admin');
$I->amOnPage('/realestate/construction-stage/index');
$I->see('Construction Stages','h1');

$I->amGoingTo('create construction stage');
$I->amOnPage('/realestate/construction-stage/create');
$I->see('Create construction stage','h1');

$I->amGoingTo('read construction stage');
$I->amOnPage(['/realestate/construction-stage/view', 'id'=>'1']);
$I->see('New','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update construction stage');
$I->amOnPage(['/realestate/construction-stage/update', 'id'=>'1']);
$I->see('Update construction stage:  New', 'h1');
$I->seeInField('ConstructionStage[name]', 'new');