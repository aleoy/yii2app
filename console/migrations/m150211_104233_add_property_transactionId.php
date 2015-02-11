<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_104233_add_property_transactionId extends Migration
{
    public $table;
    public $column;
    public $type;

    public function init()
    {
      $this->table = "{{%property}}";
      $this->column = "transactionId";
      $this->type = Schema::TYPE_INTEGER . ' NOT NULL';

      parent::init();
    }

    public function up()
    {
      $this->addColumn( $this->table, $this->column, $this->type );
    }

    public function down()
    {
        $this->dropColumn( $this->table, $this->column );
    }
}
