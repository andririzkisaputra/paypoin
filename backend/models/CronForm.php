<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\Product;
use common\models\Category;
use yii\helpers\ArrayHelper;

/**
 * Description of CronForm
 *
 * @author andri
 */
class CronForm extends Product
{
    public $type;
    public $code;
    public $name;
    public $note;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id', 'type', 'code', 'name', 'note', 'fund', 'fee', 'bill', 'price', 'price_basic', 'status', 'brand', 'category', 'provider', 'created_at', 'updated_at'], 'required'],
            [['fund', 'fee', 'price', 'price_basic', 'created_at', 'updated_at'], 'integer'],
            [['note', 'bill', 'status'], 'string'],
            [['type', 'code', 'name', 'brand', 'category', 'provider'], 'string', 'max' => 255],
        ];
    }

    public static function saveProduct($data)
    {
        $model              = new Product;
        $model->type        = $data['type'];
        $model->code        = $data['code'];
        $model->name        = $data['name'];
        $model->note        = $data['note'];
        $model->fund        = $data['fund'];
        $model->fee         = $data['fee'];
        $model->bill        = $data['bill'];
        $model->price       = $data['price'];
        $model->price_basic = $data['price_basic'];
        $model->status      = $data['status'];
        $model->brand       = $data['brand'];
        $model->category    = $data['category'];
        $model->provider    = $data['provider'];
        
        return $model->save(false);
    }

    public static function updateProduct($model, $data)
    {
        $model->type        = $data['type'];
        $model->code        = $data['code'];
        $model->name        = $data['name'];
        $model->note        = $data['note'];
        $model->fund        = $data['fund'];
        $model->fee         = $data['fee'];
        $model->bill        = $data['bill'];
        $model->price       = $data['price'];
        $model->price_basic = $data['price_basic'];
        $model->status      = $data['status'];
        $model->brand       = $data['brand'];
        $model->category    = $data['category'];

        return $model->save(false);
    }
  
    public static function saveCategory($data)
    {
        $model        = new Category;
        $model->code  = $data->c3;
        $model->name  = $data->c3;
        $model->type  = $data->c2;
        $model->real  = $data->c5;
        $model->order = $data->c6;
        $model->img   = NULL;
        
        return $model->save(false);
    }

    public static function updateCategory($model, $data)
    {
        $model->code  = $data->c3;
        $model->name  = $data->c3;
        $model->type  = $data->c2;
        $model->real  = $data->c5;
        $model->order = $data->c6;
        $model->img   = NULL;

        return $model->save(false);
    }

}
