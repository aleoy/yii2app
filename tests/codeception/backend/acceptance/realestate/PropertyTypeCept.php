<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\PropertyTypeFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure property type page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new property type');
$I->amOnPage('realestate/property-type/index');
$I->see('Property Types','h1');
$I->click('Create Property Type');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'penthouse');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a property type');
$I->seeInCurrentUrl('realestate/property-type/view?id=');
$I->see('Penthouse','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a property type');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-type/update?id=');
$I->fillField('Name', 'land');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-type/view?id=');
$I->see('land','h1');

$I->amGoingTo('delete a city');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('realestate/property-type/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'land');
$I->pressKey('input[name="PropertyTypeSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('Land');