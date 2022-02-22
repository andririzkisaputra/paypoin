<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220222_043646_create_category_table extends Migration
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
        $table = '{{%category}}';
        $this->createTable($table, [
            'id'         => $this->primaryKey(),
            'code'       => $this->string(255),
            'name'       => $this->string(255),
            'type'       => $this->string(255),
            'real'       => $this->string(255),
            'order'      => 'enum("voucher") NOT NULL DEFAULT "voucher"',
            'img'        => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
