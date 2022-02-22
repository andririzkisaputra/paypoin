<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m220222_042520_create_product_table extends Migration
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
        $table = '{{%product}}';
        $this->createTable($table, [
            'id'          => $this->primaryKey(),
            'type'        => $this->string(255),
            'code'        => $this->string(255),
            'name'        => $this->string(255),
            'note'        => $this->string(),
            'fund'        => $this->integer(25),
            'fee'         => $this->integer(25),
            'bill'        => 'enum("0", "1") NOT NULL DEFAULT "0"',
            'price'       => $this->integer(25),
            'price_basic' => $this->integer(25),
            'status'      => 'enum("available", "empty") NOT NULL DEFAULT "available"',
            'brand'       => $this->string(255),
            'img'         => $this->string(255),
            'category'    => $this->string(255),
            'provider'    => $this->string(255),
            'created_at'  => $this->integer(),
            'updated_at'  => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
