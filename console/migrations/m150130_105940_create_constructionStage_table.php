<?php

use yii\db\Schema;
use yii\db\Migration;
use console\migrations\TableOptions;

class m150130_105940_create_constructionStage_table extends Migration
{
    public function up()
    {
      $tableOptions = TableOptions::get($this);
      
      $this->createTable('{{%construction_stage}}', [
        'id' => 'pk',
        'name' => Schema::TYPE_STRING . ' NOT NULL'
      ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%construction_stage}}');
    }
}
