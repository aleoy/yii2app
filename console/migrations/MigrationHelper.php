<?php

namespace console\migrations;
use yii;

abstract class MigrationHelper
{
    //base path location of translation files
    const BASE_PATH = '@common/messages';
    //language folder where seed data is stored
    const LANGUAGE = 'lv-LV';

    public function getColumns($catalog)
    {
      $translationFile = Yii::getAlias(self::BASE_PATH) . '/' 
        . self::LANGUAGE . '/' . $catalog . '.php';

      //reading content of translation file
      $translationFileCode = file_get_contents($translationFile);
      //removing '<?php' from string
      $translationFileStr = substr($translationFileCode, 5);
      //evaluating code to get array
      $translationArr = eval($translationFileStr);
      $values = array_keys($translationArr);
      
      return $values;
    }
}