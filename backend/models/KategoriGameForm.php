<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\KategoriGame;
use yii\helpers\ArrayHelper;

/**
 * Description of KategoriGameForm
 *
 * @author andri
 */
class KategoriGameForm extends KategoriGame
{
    public $session_upload_id;
    public $kategori_game;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // kategori_game are required
            [['kategori_game'], 'required'],
            [['session_upload_id', 'id'], 'integer'],
            [['kategori_game'], 'string'],
        ];
    }

    public function simpan()
    {
        if (!$this->validate()) {
            return false;
        }
        $model = new KategoriGame;
        $model->session_upload_id = rand(100000000, 999999999);
        $model->kategori_game     = $this->kategori_game;
        $model->save();
        return $model->id; 
    }
    
}
