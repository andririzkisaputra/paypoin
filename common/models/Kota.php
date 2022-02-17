<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kota".
 *
 * @property int $kota_id
 * @property int|null $provinsi_id
 * @property string|null $nama_kota
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Kota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kota';
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
            [['nama_kota', 'provinsi_id'], 'required', 'message' => '{attribute} Tidak Boleh Kosong.'],
            [['provinsi_id', 'created_at', 'updated_at'], 'integer'],
            [['nama_kota'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provinsi_id' => 'Provinsi',
            'nama_kota'   => 'Nama Kota'
        ];
    }
}
