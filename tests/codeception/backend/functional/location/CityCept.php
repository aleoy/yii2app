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
use tests\codeception\common\_support\location\CityFixtureHelper;

$cityFixture = new CityFixtureHelper;
$cityFixture->loadFixtures();

$I = new FunctionalTester($scenario);
$I->wantTo('ensure location/city page works');

$I->amGoingTo('view cities');
$I->amLoggedAs('admin');
$I->amOnPage('/location/city/index');
$I->see('Cities','h1');

$I->amGoingTo('create city');
$I->amOnPage('/location/city/create');
$I->see('Create city','h1');
//sleep(1000);
$I->amGoingTo('read city');
$I->amOnPage(['/location/city/view', 'id'=>'1']);
$I->see('Riga','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update city');
$I->amOnPage(['/location/city/update', 'id'=>'1']);
$I->see('Update city:  Riga', 'h1');
$I->seeInField('City[name]', 'riga');