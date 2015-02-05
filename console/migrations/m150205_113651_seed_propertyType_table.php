<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\MigrationHelper;

class m150205_113651_seed_propertyType_table extends Migration
{
    private $_table = '{{%property_type}}';
    private $_catalog = 'app/realestate/propertyType';

    public function up()
    {
      $columns = MigrationHelper::getColumns($this->_catalog);
      foreach ($columns as $name) {
        $this->insert($this->_table, ['name' => $name]);
      }
    }

    public function down()
    {
      $columns = MigrationHelper::getColumns($this->_catalog);
      foreach ($columns as $name) {
        $condition = "name = :name";
        $params = [':name' => $name];
        $this->delete($this->_table, $condition, $params);
      }
    }
}
