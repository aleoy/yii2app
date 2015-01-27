<?php
namespace console\migrations;

class TableOptions
{
    public static function get($migration)
    {
        $tableOptions = null;
        if ($migration->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        return $tableOptions;
    }
}