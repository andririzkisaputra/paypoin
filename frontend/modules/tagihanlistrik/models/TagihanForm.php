<?php

namespace frontend\modules\tagihanlistrik\models;

use Yii;
use yii\base\Model;
use common\models\Trx;
use common\models\Product;
use common\components\PayPoinApi;
use common\components\Library;

/**
 * Signup form
 */
class TagihanForm extends Trx
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // kode_produk, dest are required
            [['data'], 'required'],
            [['data', 'status', 'refund'], 'string'],
            [['price', 'profit', 'created_at', 'updated_at'], 'integer'],
            [['code_bill', 'user', 'code', 'name', 'costumer_name', 'trxtype', 'provider', 'note'], 'string', 'max' => 255],
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        $PayPoinApi              = new PayPoinApi;
        $kode_tagihan            = (string)(new Library)->getRendomTagihanCode();

        $produk       = Product::findOne(['code' => $this->code]);
        $code         = str_replace('INQ','PAY',$produk->code);
        $produk_harga = Product::findOne(['code' => $code, 'category' => 'TAGIHAN LISTRIK']);
        $PayPoinApi->getTagihan([
            'kode_produk'  => $produk->code, 
            'kode_tagihan' => $kode_tagihan, 
            'dest'         => $this->data, 
        ]);
        sleep(10);
        $status = $PayPoinApi->getStatusTransaksi([
            'kode_produk'  => $produk->code, 
            'kode_tagihan' => $kode_tagihan, 
            'dest'         => $this->data, 
        ]);

        $check                  = preg_match('/sukses/i', $status);
        $array                  = explode('/',$status);
        $costumer_name          = ($check) ? str_replace('NAMA:','',$array[3]) : NULL;
        $tagihan                = new Trx();
        $tagihan->trxtype       = $produk->type;
        $tagihan->code_bill     = $kode_tagihan;
        $tagihan->code          = (string)$code;
        $tagihan->costumer_name	= (string)$costumer_name;
        $tagihan->status        = ($check) ? 'menunggu pembayaran' : 'gagal';
        $tagihan->price         = ($check) ? (int)str_replace('Ref: Tagihan RP','',$array[1])+(int)$produk_harga->price : '0';
        $tagihan->profit        = (int)$produk_harga->price/$produk_harga->price_basic;
        $tagihan->refund        = '0';
        $tagihan->data          = (string)$this->data;
        $tagihan->provider      = (string)$produk_harga->provider;
        $tagihan->name          = (string)$produk_harga->name;
        $tagihan->save();
        
        return $tagihan->id;
    }

}
