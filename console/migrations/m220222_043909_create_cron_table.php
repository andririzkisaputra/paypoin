<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cron}}`.
 */
class m220222_043909_create_cron_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // NEW TABLE
        $table = '{{%cron}}';
        $this->createTable($table, [
            'id'   => $this->primaryKey(),
            'code' => $this->string(255)->notNull(),
            'c1'   => $this->string(255)->notNull(),
            'c2'   => $this->string(255)->notNull(),
            'c3'   => $this->string(255)->notNull(),
            'c4'   => $this->string(255)->notNull(),
            'c5'   => $this->string(255)->notNull(),
            'c6'   => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cron}}');
    }
}
