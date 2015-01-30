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
use tests\codeception\common\_support\realestate\PropertyTypeFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure realestate/propertyType page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/realestate/property-type/index',
  '/realestate/property-type/create',
  ['/realestate/property-type/view', 'id'=>'1'],
  ['/realestate/property-type/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/realestate/property-type/delete?id=1');
$I->seeRecord('common\models\realestate\PropertyType', array('id' => 1));

$I->amGoingTo('view property types');
$I->amLoggedAs('admin');
$I->amOnPage('/realestate/property-type/index');
$I->see('Property Types','h1');

$I->amGoingTo('create property type');
$I->amOnPage('/realestate/property-type/create');
$I->see('Create property type','h1');

$I->amGoingTo('read property type');
$I->amOnPage(['/realestate/property-type/view', 'id'=>'1']);
$I->see('Apartment','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update property type');
$I->amOnPage(['/realestate/property-type/update', 'id'=>'1']);
$I->see('Update property type:  Apartment', 'h1');
$I->seeInField('PropertyType[name]', 'apartment');