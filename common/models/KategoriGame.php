<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kategori_game".
 *
 * @property int $id
 * @property int|null $session_upload_id
 * @property string|null $kategori_game
 * @property string|null $is_delete
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class KategoriGame extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kategori_game}}';
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
            [['session_upload_id', 'created_at', 'updated_at'], 'integer'],
            [['kategori_game'], 'string', 'max' => 255],
            [['is_delete'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_upload_id' => 'Session Upload ID',
            'kategori_game' => 'Kategori Game',
            'is_delete' => 'Is Delete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGambar()
    {
        return $this->hasMany(FileUpload::class, ['session_upload_id' => 'session_upload_id']);
    }
    
    public static function getFilename($session_upload_id)
    {
        return KategoriGame::findOne(['session_upload_id' => $session_upload_id]);
    }
    
}
