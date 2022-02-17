<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%layanan}}`.
 */
class m220131_024246_create_layanan_table extends Migration
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
        $table = '{{%layanan}}';
        $this->createTable($table, [
            'layanan_id'        => $this->primaryKey(),
            'kategori_id'       => $this->integer(11)->notNull(),
            'session_upload_id' => $this->integer(11)->notNull(),
            'nama_layanan'      => $this->string(255)->notNull(),
            'is_delete'         => 'enum("0", "1") NOT NULL DEFAULT "1" COMMENT "0. Delete, 1.Aktif"',
            'created_by'        => $this->integer(11)->notNull(),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%layanan}}');
    }
}
