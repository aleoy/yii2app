<?php

use yii\db\Schema;
use yii\db\Migration;

class m150120_114640_create_country_table extends Migration
{
    public function up()
    {
      $this->createTable('country', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ]);
    }

    public function down()
    {
        $this->dropTable('country');
    }
}
