<?php

use yii\db\Migration;

class m171015_162105_sample_initital extends Migration
{
    public function safeUp()
    {
        $this->createTable('sample',	[
            'id' => 'int(11) unsigned null default null AUTO_INCREMENT',
            'tags' => 'varchar(255) null default null',
            'user_id' => 'int(11) null default null',
            'tempo' => 'int(11) null default null',
            'key' => 'int(11) null default null',
            'title' => 'varchar(255) null default null',
            'PRIMARY KEY (`id`)'
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1');
    }

    public function safeDown()
    {
        $this->dropTable('sample');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171015_162105_sample_initital cannot be reverted.\n";

        return false;
    }
    */
}
