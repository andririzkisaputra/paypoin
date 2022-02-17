<?php

namespace frontend\modules\paketdata\models;

use Yii;
use yii\base\Model;
use common\models\Tagihan;
use common\models\Produk;
use common\components\PayPoinApi;
use common\components\Library;

/**
 * Signup form
 */
class TagihanForm extends Tagihan
{
    public $kode_produk;
    public $dest;
    public $is_emoney;
    public $is_emoney_status;
    public $provinsi_id;
    public $kota_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // kode_produk, dest are required
            [['dest'], 'required'],
            [['kode_tagihan', 'kode_produk', 'dest', 'status_tagihan', 'total_harga', 'is_emoney', 'is_emoney_status'], 'string'],
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $kode_tagihan            = (string)(new Library)->getRendomTagihanCode();
        
        $produk                  = Produk::findOne(['kode_produk' => $this->kode_produk]);
        $total_harga             = (int)($produk->harga_produk+$produk->harga_markup);
        $tagihan                 = new Tagihan();
        $tagihan->code_layanan   = $produk->code_layanan;
        $tagihan->kode_tagihan   = $kode_tagihan;
        $tagihan->kode_produk    = (string)$produk->kode_produk;
        $tagihan->status_tagihan = '0';
        $tagihan->total_harga    = (string)$total_harga;
        $tagihan->dest           = (string)$this->dest;
        $tagihan->save();
        
        return $tagihan->tagihan_id;
    }

}
