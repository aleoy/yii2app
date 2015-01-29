<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150126_112326_create_district_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable('{{%district}}', [
        'id' => 'pk',
        'cityId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'name' => Schema::TYPE_STRING . ' NOT NULL',
      ], $tableOptions);

      $name = 'fk_city_district';
      $table = 'district';
      $columns = 'cityId';
      $refTable = 'city';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
    }

    public function down()
    {
        $this->dropTable('{{%district}}');
    }
}
