<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150205_201735_create_image_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);

      $this->createTable('{{%image}}', [
        'id' => 'bigpk',
        'path' => Schema::TYPE_STRING . ' NOT NULL',
        'filename' => Schema::TYPE_STRING . ' NOT NULL',
        'extension' => Schema::TYPE_STRING . ' NOT NULL',
        'size' => Schema::TYPE_INTEGER . ' NULL',
        'height' => Schema::TYPE_INTEGER . ' NULL',
        'width' => Schema::TYPE_INTEGER . ' NULL',
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%image}}');
    }
}
