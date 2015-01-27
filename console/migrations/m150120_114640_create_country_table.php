<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150120_114640_create_country_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);
      
      $this->createTable('{{%country}}', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('country');
    }
}
