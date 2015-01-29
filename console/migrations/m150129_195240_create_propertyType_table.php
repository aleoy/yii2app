<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150129_195240_create_propertyType_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);
      
      $this->createTable('{{%property_type}}', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%property_type}}');
    }
}