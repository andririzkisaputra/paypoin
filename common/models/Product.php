<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $note
 * @property int $fund
 * @property int $fee
 * @property string $bill
 * @property int $price
 * @property int $price_basic
 * @property string $status
 * @property string $brand
 * @property string $category
 * @property string $provider
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    public $price_f;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
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
            // [['id', 'type', 'code', 'name', 'note', 'fund', 'fee', 'bill', 'price', 'price_basic', 'status', 'brand', 'category', 'provider', 'created_at', 'updated_at'], 'required'],
            [['id', 'fund', 'fee', 'price', 'price_basic', 'created_at', 'updated_at'], 'integer'],
            [['note', 'bill', 'status'], 'string'],
            [['type', 'code', 'name', 'brand', 'category', 'provider'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'code' => 'Code',
            'name' => 'Name',
            'note' => 'Note',
            'fund' => 'Fund',
            'fee' => 'Fee',
            'bill' => 'Bill',
            'price' => 'Price',
            'price_basic' => 'Price Basic',
            'status' => 'Status',
            'brand' => 'Brand',
            'category' => 'Category',
            'provider' => 'Provider',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
