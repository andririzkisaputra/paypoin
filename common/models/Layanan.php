<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "layanan".
 *
 * @property int $layanan_id
 * @property int|null $kategori_id
 * @property int|null $session_upload_id
 * @property string|null $nama_layanan
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Kategori $kategori
 * @property Produk[] $produks
 */
class Layanan extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = '0';
    const STATUS_ACTIVE  = '1';
    
    public $nama_layanan_f;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%layanan}}';
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
            [['session_upload_id', 'created_by', 'created_at', 'updated_at', 'kategori_id'], 'integer'],
            [['nama_layanan', 'code_layanan'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'layanan_id' => 'Layanan ID',
            'kategori_id' => 'Kategori ID',
            'code_layanan' => 'Layanan',
            'session_upload_id' => 'Session Upload ID',
            'nama_layanan' => 'Nama Layanan',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * Gets query for [[Produks]].
     *
     * @return \yii\db\ActiveQuery|\frontend\models\query\ProdukQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['code_layanan' => 'code']);
    }

    public function getTagihan()
    {
        return $this->hasMany(Tagihan::className(), ['layanan_id' => 'layanan_id']);
    }

    public function getGambar()
    {
        return $this->hasMany(FileUpload::class, ['session_upload_id' => 'session_upload_id']);
    }
    
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['kategori_id' => 'kategori_id']);
    }
    
    public static function getFilename($session_upload_id)
    {
        return Layanan::findOne(['session_upload_id' => $session_upload_id]);
    }

}
