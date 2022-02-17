<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tagihan}}`.
 */
class m220131_024518_create_tagihan_table extends Migration
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
        $table = '{{%tagihan}}';
        $this->createTable($table, [
            'tagihan_id'     => $this->primaryKey(),
            'layanan_id'     => $this->integer(11)->notNull(),
            'kode_tagihan'   => $this->string(255)->notNull(),
            'kode_produk'    => $this->string(255)->notNull(),
            'dest'           => $this->string(255)->notNull(),
            'status_tagihan' => 'enum("0", "1", "2", "3", "4") NOT NULL DEFAULT "0" COMMENT "0.Menunggu Pembayaran, 1.Dibayar, 2.Selesai, 3.Batal, 4.Gagal	"',
            'total_harga'    => $this->string(255)->notNull(),
            'created_by'     => $this->integer(11)->notNull(),
            'created_at'     => $this->integer(),
            'updated_at'     => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tagihan}}');
    }
}
