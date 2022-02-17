<?php

use yii\db\Migration;

/**
 * Class m220114_040250_insert_kategori
 */
class m220214_040250_insert_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // NEW INSERT DATA KATEGORI DAN FILE UPLOAD
        $tableKategori     = '{{%kategori}}';
        $tableFileUpload   = '{{%file_upload}}';

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableKategori,array(
            'kategori_id'       => 1,
            'session_upload_id' => $session_upload_id,
            'nama_kategori'     => 'Rekomendasi',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'pulsa.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableKategori,array(
            'kategori_id'       => 2,
            'session_upload_id' => $session_upload_id,
            'nama_kategori'     => 'Seluler',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'seluler.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableKategori,array(
            'kategori_id'       => 3,
            'session_upload_id' => $session_upload_id,
            'nama_kategori'     => 'Prabayar & Pascabayar',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'prabayar-&-pascabayar.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        // NEW INSERT DATA LAYANAN DAN FILE UPLOAD
        $tableLayanan = '{{%layanan}}';

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 1,
            'kategori_id'       => 2,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'Pulsa',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'pulsa.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 2,
            'kategori_id'       => 2,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'Paket Data',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'paket-data.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 3,
            'kategori_id'       => 3,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'Tagihan Listrik',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'tagihan-listrik.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 4,
            'kategori_id'       => 3,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'Token Listrik',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'token-listrik.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 5,
            'kategori_id'       => 3,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'Telkom',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'telkom.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));

        $session_upload_id = rand(100000000, 999999999);
        $this->insert($tableLayanan,array(
            'layanan_id'        => 6,
            'kategori_id'       => 3,
            'session_upload_id' => $session_upload_id,
            'nama_layanan'      => 'E-Money',
            'is_delete'         => '1',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
        $this->insert($tableFileUpload,array(
            'session_upload_id' => $session_upload_id,
            'file_name'         => 'e-money.png',
            'created_by'        => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
        ));
    }
}
