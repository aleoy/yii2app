<?php

namespace tests\codeception\common\_support\realestate;

use tests\codeception\common\fixtures\realestate\PropertySourceFixture;
use tests\codeception\common\fixtures\realestate\PropertySourceEntryPointFixture;
use Codeception\Module;
use yii\test\FixtureTrait;
use yii;

/**
 * This helper is used to populate database with needed fixtures before any tests should be run.
 * For example - populate database with demo login user that should be used in acceptance and functional tests.
 * All fixtures will be loaded before suite will be starded and unloaded after it.
 */
class PropertySourceEntryPointFixtureHelper extends Module
{

    /**
     * Redeclare visibility because codeception includes all public methods that not starts from "_"
     * and not excluded by module settings, in actor class.
     */
    use FixtureTrait {
        loadFixtures as public;
        fixtures as protected;
        globalFixtures as protected;
        unloadFixtures as protected;
        getFixtures as protected;
        getFixture as protected;
    }

    /**
     * Method called before any suite tests run. Loads User fixture login user
     * to use in acceptance and functional tests.
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $this->loadFixtures();
    }

    /**
     * Method is called after all suite tests run
     */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'propertySources' => [
                'class' => PropertySourceFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-source.php',
            ],
            'entryPoints' => [
                'class' => PropertySourceEntryPointFixture::className(),
                'dataFile' => '@tests/codeception/common/fixtures/realestate/data/property-source-entry-point.php',
            ],
        ];
    }

}
