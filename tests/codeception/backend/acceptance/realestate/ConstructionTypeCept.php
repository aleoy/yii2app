<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\ConstructionTypeFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure construction type page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new construction type');
$I->amOnPage('realestate/construction-type/index');
$I->see('Construction Types','h1');
$I->click('Create Construction Type');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'wood');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a property type');
$I->seeInCurrentUrl('realestate/construction-type/view?id=');
$I->see('Wood','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a property type');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/construction-type/update?id=');
$I->fillField('Name', 'kryptonite');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/construction-type/view?id=');
$I->see('kryptonite','h1');

$I->amGoingTo('delete a construction type');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('realestate/construction-type/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'kryptonite');
$I->pressKey('input[name="ConstructionTypeSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('kryptonite');