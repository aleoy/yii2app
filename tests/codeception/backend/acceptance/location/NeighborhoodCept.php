<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\location\NeighborhoodFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure neighborhood page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new neighborhood');
$I->amOnPage('location/neighborhood/index');
$I->see('Neighborhoods','h1');
$I->click('Create Neighborhood');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'vecrīga');
$I->selectOption('Neighborhood[cityId]', 'riga');
$I->selectOption('Neighborhood[districtId]', 'central');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a neighborhood');
$I->seeInCurrentUrl('location/neighborhood/view?id=');
$I->see('vecrīga','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a neighborhood');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/neighborhood/update?id=');
$I->fillField('Name', 'zelda');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('location/neighborhood/view?id=');
$I->see('zelda','h1');

$I->amGoingTo('delete a neighborhood');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('location/neighborhood/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'zelda');
$I->pressKey('input[name="NeighborhoodSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('zelda');