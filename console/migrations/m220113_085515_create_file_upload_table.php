<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session_upload}}`.
 */
class m220113_085515_create_file_upload_table extends Migration
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
        $table = '{{%file_upload}}';
        $this->createTable($table, [
            'file_upload_id'    => $this->primaryKey(),
            'session_upload_id' => $this->integer(11)->notNull(),
            'file_name'         => $this->string()->notNull(),
            'created_by'        => $this->integer(11)->notNull(),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_upload}}');
    }
}
