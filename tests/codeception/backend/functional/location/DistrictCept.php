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
use tests\codeception\common\_support\location\DistrictFixtureHelper;

$districtFixture = new DistrictFixtureHelper;
$districtFixture->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure location/district page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/location/district/index',
  '/location/district/create',
  ['/location/district/view', 'id'=>'1'],
  ['/location/district/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/location/district/delete?id=1');
$I->seeRecord('common\models\location\District', array('id' => 1));

$I->amGoingTo('view districts');
$I->amLoggedAs('admin');
$I->amOnPage('/location/district/index');
$I->see('Districts','h1');

$I->amGoingTo('create district');
$I->amOnPage('/location/district/create');
$I->see('Create district','h1');

$I->amGoingTo('read district');
$I->amOnPage(['/location/district/view', 'id'=>'1']);
$I->see('Central','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update district');
$I->amOnPage(['/location/district/update', 'id'=>'1']);
$I->see('Update district:  Central', 'h1');
$I->seeInField('District[name]', 'central');
$I->seeOptionIsSelected('District[cityId]', 'riga');