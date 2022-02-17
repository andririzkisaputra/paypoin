<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\Layanan;
use yii\helpers\ArrayHelper;

/**
 * Description of LayananForm
 *
 * @author andri
 */
class LayananForm extends Layanan
{
    public $kategori_id;
    public $session_upload_id;
    public $nama_layanan;
    public $created_by;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // nama_layanan, kategori_id are required
            [['nama_layanan', 'kategori_id'], 'required'],
            [['session_upload_id', 'created_by', 'kategori_id'], 'integer'],
            [['nama_layanan'], 'string'],
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        $model = new Layanan;
        $code  = strtolower($this->nama_layanan);
        $code  = str_replace(" ", "-", $code);
        $model->kategori_id       = $this->kategori_id;
        $model->session_upload_id = rand(100000000, 999999999);
        $model->nama_layanan      = $this->nama_layanan;
        $model->code              = $code;
        $model->created_by        = Yii::$app->user->identity->id;
        $model->save();
        return $model->layanan_id; 
    }
    
}
