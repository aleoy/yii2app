<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150130_120441_create_propertySource_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);
      
      $this->createTable('{{%property_source}}', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%property_source}}');
    }
}
