<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%trx}}".
 *
 * @property int $id
 * @property string|null $code_bill
 * @property string|null $user
 * @property string|null $code
 * @property string|null $name
 * @property string|null $costumer_name
 * @property string|null $data
 * @property int|null $price
 * @property int|null $profit
 * @property string|null $status
 * @property string|null $refund
 * @property string|null $trxtype
 * @property string|null $provider
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Trx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trx}}';
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
            [['data', 'status', 'refund'], 'string'],
            [['price', 'profit', 'created_at', 'updated_at'], 'integer'],
            [['code_bill', 'user', 'code', 'name', 'costumer_name', 'trxtype', 'provider'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_bill' => 'Code Bill',
            'user' => 'User',
            'code' => 'Code',
            'name' => 'Name',
            'costumer_name' => 'Costumer Name',
            'data' => 'Data',
            'price' => 'Price',
            'profit' => 'Profit',
            'status' => 'Status',
            'refund' => 'Refund',
            'trxtype' => 'Trxtype',
            'provider' => 'Provider',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
