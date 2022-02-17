<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "produk".
 *
 * @property int $produk_id
 * @property string|null $kode_produk
 * @property string|null $nama_produk
 * @property int|null $kategori_id
 * @property string $is_delete 0. Delete, 1.Aktif
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Kategori $kategori
 */
class Produk extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = '0';
    const STATUS_ACTIVE  = '1';
    public $total_harga;
    public $total_harga_f;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%produk}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['is_delete', 'jenis', 'sub_produk', 'kategori_game'], 'string'],
            [['kode_produk', 'harga_markup', 'harga_markdown', 'nama_produk', 'code_layanan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'produk_id' => 'Produk ID',
            'kode_produk' => 'Kode Produk',
            'kategori_game' => 'Kategori Game',
            'nama_produk' => 'Nama Produk',
            'is_delete' => 'Is Delete',
            'sub_produk' => 'Sub Produk',
            'jenis' => 'Jenis',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getLayanan()
    {
        return $this->hasOne(Layanan::className(), ['code' => 'code_layanan']);
    }

    public function getTagihan()
    {
        return $this->hasOne(Tagihan::className(), ['kode_produk' => 'kode_produk']);
    }
    
    public function getGambar()
    {
        return $this->hasMany(FileUpload::class, ['session_upload_id' => 'session_upload_id']);
    }

}
