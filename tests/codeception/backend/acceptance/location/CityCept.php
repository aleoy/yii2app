<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\location\CityFixtureHelper;

$cityFixture = new CityFixtureHelper;
$cityFixture->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure city page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new city');
$I->amOnPage('location/city/index');
$I->see('Cities','h1');
$I->click('Create City');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'jelgava');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a city');
$I->seeInCurrentUrl('location/city/view?id=');
$I->see('Jelgava','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a city');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/city/update?id=');
$I->fillField('Name', 'olaine');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/city/view?id=');
$I->see('olaine','h1');

$I->amGoingTo('delete a city');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('location/city/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'olaine');
$I->pressKey('input[name="CitySearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('Olaine');