<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "provinsi".
 *
 * @property int $provinsi_id
 * @property string|null $nama_provinsi
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%provinsi}}';
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
            [['nama_provinsi'], 'required', 'message' => '{attribute} Tidak Boleh Kosong.'],
            [['created_at', 'updated_at'], 'integer'],
            [['nama_provinsi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nama_provinsi' => 'Nama Provinsi',
        ];
    }
}
