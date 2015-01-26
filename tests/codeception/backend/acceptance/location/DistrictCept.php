<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\location\DistrictFixtureHelper;

$districtFixture = new DistrictFixtureHelper;
$districtFixture->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure district page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new district');
$I->amOnPage('location/district/index');
$I->see('Districts','h1');
$I->click('Create District');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'kurzeme');
$I->selectOption('District[cityId]', 'riga');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a district');
$I->seeInCurrentUrl('location/district/view?id=');
$I->see('kurzeme','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a district');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/district/update?id=');
$I->fillField('Name', 'latgale');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/district/view?id=');
$I->see('latgale','h1');

$I->amGoingTo('delete a district');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('location/district/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'latgale');
$I->pressKey('input[name="DistrictSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('latgale');