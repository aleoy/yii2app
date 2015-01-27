<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150127_180316_create_neighborhood_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable('{{%neighborhood}}', [
        'id' => 'pk',
        'cityId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'districtId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'name' => Schema::TYPE_STRING . ' NOT NULL',
      ], $tableOptions);

      $name = 'fk_city_neighborhood';
      $table = 'neighborhood';
      $columns = 'cityId';
      $refTable = 'city';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
      $name = 'fk_district_neighborhood';
      $columns = 'districtId';
      $refTable = 'district';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
    }

    public function down()
    {
        $this->dropTable('neighborhood');
    }
}
