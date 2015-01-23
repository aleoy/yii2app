<?php

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\backend\_pages\CountryPage;
use Yii\helpers\Url as Url;

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure country page works');

$I->amLoggedAs('admin', 'password', $I);

$I->amOnPage('location/country/index');
$I->see('Countries','h1');
