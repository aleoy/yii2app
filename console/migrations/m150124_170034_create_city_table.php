<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150124_170034_create_city_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable('{{%city}}', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('city');
    }
}
