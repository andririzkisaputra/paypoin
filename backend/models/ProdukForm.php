<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\Product;
use yii\helpers\ArrayHelper;

/**
 * Description of ProdukForm
 *
 * @author andri
 */
class ProdukForm extends Produk
{
    public $code_layanan;
    public $kode_produk;
    public $nama_produk;
    public $harga_markup;
    public $jenis;
    public $sub_produk;
    public $is_emoney;
    public $is_emoney_status;
    public $kategori_game;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // kode_produk, nama_produk,  code_layanan are required
            [['kode_produk', 'nama_produk', 'code_layanan'], 'required', 'message'=>'{attribute} Tidak Boleh Kosong.'],
            [['created_by', 'provinsi_id', 'kota_id'], 'integer'],
            [['kode_produk', 'nama_produk', 'harga_markup', 'jenis', 'is_emoney', 'is_emoney_status', 'code_layanan', 'kategori_game'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code_layanan'  => 'Layanan',
            'kode_produk' => 'Kode Produk',
            'nama_produk' => 'Nama Produk',
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        $model = new Product;
        $model->code_layanan     = $this->code_layanan;
        $model->provinsi_id      = ($this->provinsi_id)      ? $this->provinsi_id      : '0';
        $model->kota_id          = ($this->kota_id)          ? $this->kota_id          : '0';
        $model->kode_produk      = $this->kode_produk;
        $model->sub_produk       = ($this->sub_produk)       ? $this->sub_produk       : '0';
        $model->nama_produk      = ($this->nama_produk)      ? $this->nama_produk      : '0';   
        $model->harga_markdown   = ($this->harga_markdown)   ? $this->harga_markdown   : '0';
        $model->harga_markup     = ($this->harga_markup)     ? $this->harga_markup     : '0';
        $model->jenis            = ($this->jenis)            ? $this->jenis            : '2';
        $model->is_emoney        = ($this->is_emoney)        ? $this->is_emoney        : NULL;
        $model->kategori_game    = ($this->kategori_game)    ? $this->kategori_game    : NULL;
        $model->is_emoney_status = ($this->is_emoney_status) ? $this->is_emoney_status : NULL;
        $model->created_by       = Yii::$app->user->identity->id;
        $model->save();
        return $model->produk_id; 
    }
    
}
