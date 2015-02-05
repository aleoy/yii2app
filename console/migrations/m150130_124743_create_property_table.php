<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150130_124743_create_property_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);
      
      $this->createTable('{{%property}}', [
        'id' => 'bigpk',
        'addressId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'typeId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'constructionTypeId' => Schema::TYPE_INTEGER . ' NULL',
        'constructionStageId' => Schema::TYPE_INTEGER . ' NULL',
        'sourceId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'sourceUrl' => Schema::TYPE_STRING . ' NULL',
        'dateOnMarket' => Schema::TYPE_TIMESTAMP . ' NULL',
        'dateOffMarket' => Schema::TYPE_TIMESTAMP . ' NULL',
        'title' => Schema::TYPE_STRING . ' NULL',
        'description' => Schema::TYPE_TEXT . ' NULL',
        'floorArea' => Schema::TYPE_INTEGER . ' NOT NULL',
        'onFloor' => Schema::TYPE_INTEGER . ' NULL',
        'totalFloor' => Schema::TYPE_INTEGER . ' NULL',
        'hasLift' => Schema::TYPE_BOOLEAN . ' NOT NULL',
        'rooms' => Schema::TYPE_INTEGER . ' NOT NULL',
        'parking' => Schema::TYPE_INTEGER . ' NULL',
        'price' => Schema::TYPE_MONEY . ' NULL',
        'otherDetails' => Schema::TYPE_TEXT . ' NULL',
        'createdBy' => Schema::TYPE_INTEGER . ' NULL',
        'createdAt' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        'updatedBy' => Schema::TYPE_INTEGER . ' NULL',
        'updatedAt' => Schema::TYPE_TIMESTAMP . ' NULL',

      ], $tableOptions);

      $name = 'fk_address_property';
      $table = 'property';
      $columns = 'addressId';
      $refTable = 'address';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
      $name = 'fk_type_property';
      $columns = 'typeId';
      $refTable = 'property_type';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
      $name = 'fk_source_property';
      $columns = 'sourceId';
      $refTable = 'property_source';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
    }

    public function down()
    {
        $this->dropTable('{{%property}}');
    }
}
