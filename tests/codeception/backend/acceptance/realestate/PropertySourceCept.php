<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\PropertySourceFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure property source page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new property source');
$I->amOnPage('realestate/property-source/index');
$I->see('Property sources','h1');
$I->click('Create Property Source');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'zorro.com');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a property source');
$I->seeInCurrentUrl('realestate/property-source/view?id=');
$I->see('Zorro.com','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a property source');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-source/update?id=');
$I->fillField('Name', 'bancho.mx');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/property-source/view?id=');
$I->see('bancho.mx','h1');

$I->amGoingTo('delete a property source');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('realestate/property-source/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'bancho.mx');
$I->pressKey('input[name="PropertySourceSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('bancho.mx');