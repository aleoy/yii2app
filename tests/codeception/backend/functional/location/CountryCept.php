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
use tests\codeception\common\_support\location\CountryFixtureHelper;

$countryFixture = new CountryFixtureHelper;
$countryFixture->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure location/country page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/location/country/index',
  '/location/country/create',
  ['/location/country/view', 'id'=>'1'],
  ['/location/country/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/location/country/delete?id=1');
$I->seeRecord('common\models\location\Country', array('id' => 1));

$I->amGoingTo('view countries');
$I->amLoggedAs('admin');
$I->amOnPage('/location/country/index');
$I->see('Countries','h1');

$I->amGoingTo('create country');
$I->amOnPage('/location/country/create');
$I->see('Create Country','h1');

$I->amGoingTo('read country');
$I->amOnPage(['/location/country/view', 'id'=>'1']);
$I->see('Latvia','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update country');
$I->amOnPage(['/location/country/update', 'id'=>'1']);
$I->see('Update Country:  latvia', 'h1');
$I->seeInField('Country[name]', 'latvia');
