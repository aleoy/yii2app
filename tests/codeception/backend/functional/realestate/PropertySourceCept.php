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
use tests\codeception\common\_support\realestate\PropertySourceFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure realestate/propertySource page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/realestate/property-source/index',
  '/realestate/property-source/create',
  ['/realestate/property-source/view', 'id'=>'1'],
  ['/realestate/property-source/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/realestate/property-source/delete?id=1');
$I->seeRecord('common\models\realestate\PropertySource', array('id' => 1));

$I->amGoingTo('view property sources');
$I->amLoggedAs('admin');
$I->amOnPage('/realestate/property-source/index');
$I->see('Property Sources','h1');

$I->amGoingTo('create property source');
$I->amOnPage('/realestate/property-source/create');
$I->see('Create property source','h1');

$I->amGoingTo('read property source');
$I->amOnPage(['/realestate/property-source/view', 'id'=>'1']);
$I->see('Majas.lv','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update property source');
$I->amOnPage(['/realestate/property-source/update', 'id'=>'1']);
$I->see('Update property source:  Majas.lv', 'h1');
$I->seeInField('PropertySource[name]', 'majas.lv');