<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\PropertySourceEntryPointFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure property source entry point page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new property source entry point');
$I->amOnPage('realestate/property-source-entry-point/index');
$I->see('Property source entry point','h1');
$I->click('Create Property Source Entry Point');

$I->amGoingTo('fill in the form');
$I->selectOption('PropertySourceEntryPoint[sourceId]', 'ss.lv');
$I->fillField('Url', 'https://www.ss.lv/lv/real-estate/plots-and-lands');
$I->fillField('Description', 'lands and plots');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a property source entry point');
$I->seeInCurrentUrl('realestate/property-source-entry-point/view?id=');
$I->see('lands and plots','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a property source entry point');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-source-entry-point/update?id=');
$I->selectOption('PropertySourceEntryPoint[sourceId]', 'majas.lv');
$I->fillField('Url', 'https://www.majas.lv/lv/real-estate/houses');
$I->fillField('Description', 'houses');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-source-entry-point/view?id=');
$I->see('houses','h1');

$I->amGoingTo('delete a property source entry point');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('realestate/property-source-entry-point/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'houses');
$I->pressKey('input[name="PropertySourceEntryPointSearchModel[description]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('houses');