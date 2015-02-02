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
use tests\codeception\common\_support\realestate\PropertySourceEntryPointFixtureHelper as FixtureHelper;
use common\models\realestate\PropertySource;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure realestate/propertySourceEntryPoint page works');

$I->amGoingTo('check actions authorizations');
//as guest
$routes = [
  '/realestate/property-source-entry-point/index',
  '/realestate/property-source-entry-point/create',
  ['/realestate/property-source-entry-point/view', 'id'=>'1'],
  ['/realestate/property-source-entry-point/update', 'id'=>'1'],
];

foreach($routes as $route){
  $I->amOnPage($route);
  $I->see('Login','h1');
}

$I->sendAjaxRequest('POST', '/realestate/property-source-entry-point/delete?id=1');
$I->seeRecord('common\models\realestate\PropertySourceEntryPoint', array('id' => 1));

$I->amGoingTo('view property sources');
$I->amLoggedAs('admin');
$I->amOnPage('/realestate/property-source-entry-point/index');
$I->see('Property Source Entry Points','h1');

$I->amGoingTo('create property source entry point');
$I->amOnPage('/realestate/property-source-entry-point/create');
$I->see('Create property source entry point','h1');

$I->amGoingTo('read property source entry point');
$I->amOnPage(['/realestate/property-source-entry-point/view', 'id'=>'1']);
$I->see('listing of all apartments in riga','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update property source entry point');
$I->amOnPage(['/realestate/property-source-entry-point/update', 'id'=>'1']);
$I->see('Update property source entry point:  listing of all apartments in riga', 'h1');
$I->seeOptionIsSelected('PropertySourceEntryPoint[sourceId]', PropertySource::findOne(['name'=>'ss.lv'])->name);
$I->seeInField('PropertySourceEntryPoint[url]', 'https://www.ss.lv/lv/real-estate/flats/riga/all/');
$I->seeInField('PropertySourceEntryPoint[description]', 'listing of all apartments in riga');