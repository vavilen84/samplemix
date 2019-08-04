<?php

use yii\db\Migration;

class m171107_024508_mix_initial extends Migration
{
    public function safeUp()
    {
        $this->createTable('mix', [
            'id' => 'int(11) unsigned null default null  AUTO_INCREMENT',
            'user_id' => 'int(11) null default null',
            'title' => 'varchar(255) null default null',
            'json' => 'text',
            'status' => 'int(11) null default null',
            'PRIMARY KEY (`id`)'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        echo "m171107_024508_mix_initial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171107_024508_mix_initial cannot be reverted.\n";

        return false;
    }
    */
}
