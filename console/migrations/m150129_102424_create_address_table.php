<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150129_102424_create_address_table extends Migration
{
    private $_table = '{{%address}}';

    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable($this->_table, [
        'id' => 'pk',
        'cityId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'districtId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'neighborhoodId' => Schema::TYPE_INTEGER . ' NULL',
        'streetName' => Schema::TYPE_STRING . ' NOT NULL',
        'streetNumber' => Schema::TYPE_STRING . ' NOT NULL',
        'buildingNumber' => Schema::TYPE_STRING . ' NULL',
        'postCode' => Schema::TYPE_STRING . ' NULL',
        'complement' => Schema::TYPE_STRING . ' NULL',
        'latitude' => Schema::TYPE_FLOAT . ' (10,6) NOT NULL',
        'longitude' => Schema::TYPE_FLOAT . ' (10, 6) NOT NULL',
      ], $tableOptions);

      $name = 'fk_city_address';
      $columns = 'cityId';
      $refTable = 'city';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $this->_table, $columns, $refTable, $refColumns, $delete, $update
      );
    
      $name = 'fk_district_address';
      $columns = 'districtId';
      $refTable = 'district';
      $this->addForeignKey(
        $name, $this->_table, $columns, $refTable, $refColumns, $delete, $update
      );
    }

    public function down()
    {
      $this->dropTable($this->_table);
    }
}
