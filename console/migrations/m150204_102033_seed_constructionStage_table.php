<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\MigrationHelper;

class m150204_102033_seed_constructionStage_table extends Migration
{
    private $_table = '{{%construction_stage}}';
    private $_catalog = 'realestate/constructionStage';

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
