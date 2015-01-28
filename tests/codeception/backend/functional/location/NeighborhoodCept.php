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
use tests\codeception\common\_support\location\NeighborhoodFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure location/neighborhood page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/location/neighborhood/index',
  '/location/neighborhood/create',
  ['/location/neighborhood/view', 'id'=>'1'],
  ['/location/neighborhood/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/location/neighborhood/delete?id=1');
$I->seeRecord('common\models\location\Neighborhood', array('id' => 1));

$I->amGoingTo('view neighborhoods');
$I->amLoggedAs('admin');
$I->amOnPage('/location/neighborhood/index');
$I->see('Neighborhoods','h1');

$I->amGoingTo('create neighborhood');
$I->amOnPage('/location/neighborhood/create');
$I->see('Create neighborhood','h1');

$I->amGoingTo('read neighborhood');
$I->amOnPage(['/location/neighborhood/view', 'id'=>'1']);
$I->see('Centrs','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update neighborhood');
$I->amOnPage(['/location/neighborhood/update', 'id'=>'1']);
$I->see('Update neighborhood:  Centrs', 'h1');
$I->seeInField('Neighborhood[name]', 'centrs');
$I->seeOptionIsSelected('Neighborhood[cityId]', 'riga');
$I->seeOptionIsSelected('Neighborhood[districtId]', 'central');