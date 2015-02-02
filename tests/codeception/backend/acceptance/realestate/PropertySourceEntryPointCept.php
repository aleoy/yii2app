<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\common\_support\realestate\PropertySourceEntryPointFixtureHelper as FixtureHelper;

$fixtureHelper = new FixtureHelper;
$fixtureHelper->loadFixtures();

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure property source entry point page works');

$this->fail('needs to be implemented');