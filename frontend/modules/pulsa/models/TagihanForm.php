<?php

namespace frontend\modules\pulsa\models;

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
        
        $kode_tagihan       = (string)(new Library)->getRendomTagihanCode();
        $produk             = Product::findOne(['code' => $this->code]);
        $tagihan            = new Trx();
        $tagihan->trxtype   = $produk->type;
        $tagihan->code_bill = $kode_tagihan;
        $tagihan->code      = (string)$produk->code;
        $tagihan->name      = (string)$produk->name;
        $tagihan->status    = 'menunggu pembayaran';
        $tagihan->price     = (int)$produk->price;
        $tagihan->provider  = (string)$produk->provider;
        $tagihan->name      = (string)$produk->name;
        $tagihan->profit    = (int)$produk->price/$produk->price_basic;
        $tagihan->data      = (string)$this->data;
        $tagihan->save();

        return $tagihan->id;
    }

}
