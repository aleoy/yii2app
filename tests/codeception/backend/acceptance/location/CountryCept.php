<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\location\CountryFixtureHelper;

$countryFixture = new CountryFixtureHelper;
$countryFixture->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure country page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->see('Congratulations!');

$I->amGoingTo('create a new country');
$I->amOnPage('location/country/index');
$I->see('Countries','h1');
$I->click('Create Country');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'russia');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a country');
$I->seeInCurrentUrl('location/country/view?id=');
$I->see('Russia','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a country');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/country/update?id=');
$I->fillField('Name', 'moldova');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('delete a country');
$I->seeInCurrentUrl('location/country/view?id=');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~');
$I->see('Moldova','h1');
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}


$I->amOnPage('location/country/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'moldova');
$I->pressKey('input[name="CountrySearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('Moldova');