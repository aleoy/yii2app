<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\ConstructionStageFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure construction stage page works');

$I->amLoggedAs('admin', 'password', $I);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('create a new construction stage');
$I->amOnPage('realestate/construction-stage/index');
$I->see('Construction Stages','h1');
$I->click('Create Construction Stage');

$I->amGoingTo('fill in the form');
$I->fillField('Name', 'off plan');
$I->click('Create');
$I->expect('the form is submitted');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amGoingTo('read a property stage');
$I->seeInCurrentUrl('realestate/construction-stage/view?id=');
$I->see('Off plan','h1');
$I->see('Update');
$I->see('Delete');

$I->amGoingTo('update a property stage');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/construction-stage/update?id=');
$I->fillField('Name', 'under construction');
$I->click('Update');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeInCurrentUrl('realestate/construction-stage/view?id=');
$I->see('under construction','h1');

$I->amGoingTo('delete a construction stage');
$countryId = $I->grabFromCurrentUrl('~view\?id=(\d+)~'); 
$I->executeJS("window.confirm = function(){return true;}");
$I->click('Delete');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}

$I->amOnPage('realestate/construction-stage/index');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->fillField('//*[@id="w0-filters"]/td[3]/input', 'under construction');
$I->pressKey('input[name="ConstructionStageSearchModel[name]"]', WebDriverKeys::ENTER);
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->dontSee('under construction');