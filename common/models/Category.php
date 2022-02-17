<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $type
 * @property string|null $real
 * @property string|null $order
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['order'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['code', 'name', 'type', 'real'], 'string', 'max' => 255],
            [
                ['img'], 
                'file', 
                'skipOnEmpty' => true, 
                'extensions' =>  ['png', 'jpg', 'jpeg', 'bmp'], 
                'maxFiles' => 1
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'type' => 'Type',
            'real' => 'Real',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
