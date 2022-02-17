<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\Category;
use yii\helpers\ArrayHelper;

/**
 * Description of KategoriForm
 *
 * @author andri
 */
class KategoriForm extends Category
{
    public $nama_kategori;
    public $created_by;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // nama_kategori are required
            // [['nama_kategori'], 'required'],
            [['session_upload_id', 'created_by', 'kategori_id'], 'integer'],
            [['nama_kategori'], 'string'],
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        $model = new Kategori;
        $model->session_upload_id = rand(100000000, 999999999);
        $model->nama_kategori     = $this->nama_kategori;
        $model->created_by        = Yii::$app->user->identity->id;
        $model->save();
        return $model->kategori_id; 
    }
    
}
