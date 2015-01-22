<?php 
/*
 * What to Include in your Functional Tests
 * You should test for things such as:
 * - was the web request successful?
 * - was the user redirected to the right page?
 * - was the user successfully authenticated?
 * - was the correct object stored in the response template?
 * - was the appropriate message displayed to the user in the view?
 */
use tests\codeception\backend\FunctionalTester;
use Yii\helpers\Url;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure location module page works');

$I->amGoingTo('view countries');
$I->amLoggedAs('admin');
$I->amOnPage(Url::to(['/location/country/index']));
$I->see('Countries','h1');

$I->amGoingTo('create country');
$I->amOnPage(Url::to(['/location/country/create']));
$I->see('Create Country','h1');

$I->amGoingTo('read country');
$I->amOnPage(Url::to(['/location/country/view', 'id'=>'1']));
$I->see('Latvia','h1');
$I->see('Delete', '.btn.btn-danger');
$I->see('Update', '.btn.btn-primary');

$I->amGoingTo('update country');
$I->amOnPage(Url::to(['/location/country/update', 'id'=>'1']));
$I->see('Update Country:  latvia', 'h1');
$I->seeInField('Country[name]', 'latvia');
