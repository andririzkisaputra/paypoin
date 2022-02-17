<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produk}}`.
 */
class m220113_081656_create_produk_table extends Migration
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
        $table = '{{%produk}}';
        $this->createTable($table, [
            'produk_id'    => $this->primaryKey(),
            'layanan_id'   => $this->integer(11)->notNull(),
            'kode_produk'  => $this->string(255)->notNull(),
            'nama_produk'  => $this->string(255)->notNull(),
            'harga_markup' => $this->string(255)->notNull(),
            'sub_produk'   => $this->string(255)->notNull()->comment('0. Other 1. Telkomsel 2. Indosat 3. XL 4. Axis 5. Smartfreen 6. Three	'),
            'jenis'        => 'enum("1", "2") NOT NULL DEFAULT "2" COMMENT "1. Cek Tagihan 2. Bayar"',
            'is_delete'    => 'enum("0", "1") NOT NULL DEFAULT "1" COMMENT "0. Delete, 1.Aktif"',
            'created_by'   => $this->integer(11)->notNull(),
            'created_at'   => $this->integer(),
            'updated_at'   => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%produk}}');
    }
}
