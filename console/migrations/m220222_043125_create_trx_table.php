<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trx}}`.
 */
class m220222_043125_create_trx_table extends Migration
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
        $table = '{{%trx}}';
        $this->createTable($table, [
            'id'            => $this->primaryKey(),
            'code_bill'     => $this->string(255)->notNull(),
            'user'          => $this->string(255)->notNull(),
            'code'          => $this->string(255)->notNull(),
            'name'          => $this->string(255)->notNull(),
            'costumer_name' => $this->string()->notNull(),
            'note'          => $this->string(255)->notNull(),
            'data'          => $this->string()->notNull(),
            'price'         => $this->integer(25)->notNull(),
            'profit'        => $this->integer(25)->notNull(),
            'status'        => 'enum("menunggu pembayaran", "terbayar", "proses", "sukses", "gagal") NOT NULL DEFAULT "menunggu pembayaran"',
            'refund'        => 'enum("0", "1") NOT NULL DEFAULT "0"',
            'trxtype'       => $this->string(255)->notNull(),
            'provider'      => $this->string(255)->notNull(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%trx}}');
    }
}
