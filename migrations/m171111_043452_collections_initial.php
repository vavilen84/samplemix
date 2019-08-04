<?php

use yii\db\Migration;

class m171111_043452_collections_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('collection', [
            'id' => 'int(11) unsigned null default null  AUTO_INCREMENT',
            'user_id' => 'int(11) null default null',
            'title' => 'varchar(255) null default null',
            'json' => 'text',
            'PRIMARY KEY (`id`)'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        echo "m171111_043452_collections_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171111_043452_collections_initial cannot be reverted.\n";

        return false;
    }
    */
}
