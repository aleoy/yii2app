<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150202_115815_create_propertySourceEntryPoint extends Migration
{

    protected $table = '{{%property_source_entry_point}}';

    public function up()
    {
      $tableOptions = TableOptions::get($this);
      

      $this->createTable($this->table, [
        'id' => 'pk',
        'sourceId' => Schema::TYPE_INTEGER . ' NOT NULL',
        'statusId'  => Schema::TYPE_INTEGER . ' NOT NULL',
        'startedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
        'finishedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
        'url' => Schema::TYPE_STRING . ' NOT NULL',
        'currentPage'  => Schema::TYPE_INTEGER . ' NULL',
        'description'  => Schema::TYPE_STRING . ' NULL',
      ], $tableOptions);

      $name = 'fk_property_source_entry_point';
      $table = 'property_source_entry_point';
      $columns = 'sourceId';
      $refTable = 'property_source';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );


      $indexName = 'un_property_source_entry_point_url';
      $columns = 'url';
      $unique = true ;
      $this->createIndex($indexName, $this->table, $columns, $unique);
    }

    public function down()
    {
        $this->dropTable($this->table);
    }
}
