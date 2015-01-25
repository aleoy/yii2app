<?php

use yii\db\Schema;
use yii\db\Migration;

class m150124_170034_create_city_table extends Migration
{
    public function up()
    {
      $this->createTable('city', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ]);
    }

    public function down()
    {
        $this->dropTable('city');
    }
}
