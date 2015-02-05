<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150205_201849_create_propertyImage_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable('{{%property_image}}', [
        'propertyId' => Schema::TYPE_BIGINT . ' NOT NULL',
        'imageId' => Schema::TYPE_BIGINT . ' NOT NULL',
      ], $tableOptions);

      $name = 'fk_property_propertyImage';
      $table = 'property_image';
      $columns = 'propertyId';
      $refTable = 'property';
      $refColumns = 'id';
      $delete = 'CASCADE';
      $update = 'CASCADE';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
      $name = 'fk_image_propertyImage';
      $columns = 'imageId';
      $refTable = 'image';
      $this->addForeignKey(
        $name, $table, $columns, $refTable, $refColumns, $delete, $update
      );
    }

    public function down()
    {
        $this->dropTable('{{%property_image}}');
    }
}
