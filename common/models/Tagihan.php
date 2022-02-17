<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tagihan".
 *
 * @property int $tagihan_id
 * @property int|null $kode_tagihan
 * @property int|null $kode_produk
 * @property string $status_tagihan
 * @property string|null $total_harga
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Tagihan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tagihan}}';
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
            [['created_at', 'updated_at'], 'integer'],
            [['kode_tagihan', 'code_layanan', 'status_tagihan', 'kode_produk'], 'string'],
            [['total_harga'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tagihan_id' => 'Tagihan ID',
            'code_layanan' => 'Code Layanan',
            'kode_tagihan' => 'Kode Tagihan',
            'kode_produk' => 'Kode Produk',
            'status_tagihan' => 'Status Tagihan',
            'total_harga' => 'Total Harga',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getLayanan()
    {
        return $this->hasOne(Layanan::className(), ['code' => 'code_layanan']);
    }

    public function getOrders()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasOne(Produk::className(), ['kode_produk' => 'kode_produk']);
    }


}
