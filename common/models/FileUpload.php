<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "file_upload".
 *
 * @property int $session_upload_id
 * @property string $file_name
 * @property int $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class FileUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file_upload}}';
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
            [['session_upload_id'], 'required'],
            [['session_upload_id', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file_upload_id' => 'File Upload ID',
            'session_upload_id' => 'Session Upload ID',
            'file_name' => 'File Name',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function uploadKategori($session_upload_id, $nama_kategori)
    {
        $model = new FileUpload();
        $model->file_name = UploadedFile::getInstance($model, 'file_name');
        $nama_format = strtolower($nama_kategori);
        $nama_format = str_replace(" ", "-", $nama_format).'.'.$model->file_name->extension;
        $url_file    = '@uploads/kategori/'.$nama_format;
        $model->file_name->saveAs($url_file);
        // $imagine  = Image::getImagine();
        // $image    = $imagine->open(Yii::getAlias('@uploads').'/kategori/'.$nama_format);
        // $url_file = Yii::getAlias('@uploads').'/kategori/thumb/thumb_'.$nama_format;
        // $image->resize(new Box(400, 400))->save($url_file, ['quality' => 70]);
        $model->file_name         = $nama_format;
        $model->session_upload_id = $session_upload_id;
        $model->created_by        = 1;
        return $model->save(false);
    }

    public function uploadLayanan($session_upload_id, $nama_layanan)
    {
        $model = new FileUpload();
        $model->file_name = UploadedFile::getInstance($model, 'file_name');
        $nama_format = strtolower($nama_layanan);
        $nama_format = str_replace(" ", "-", $nama_format).'.'.$model->file_name->extension;
        $url_file    = '@uploads/kategori/'.$nama_format;
        $model->file_name->saveAs($url_file);
        // $imagine  = Image::getImagine();
        // $image    = $imagine->open(Yii::getAlias('@uploads').'/kategori/'.$nama_format);
        // $url_file = Yii::getAlias('@uploads').'/kategori/thumb/thumb_'.$nama_format;
        // $image->resize(new Box(400, 400))->save($url_file, ['quality' => 70]);
        $model->file_name         = $nama_format;
        $model->session_upload_id = $session_upload_id;
        $model->created_by        = 1;
        return $model->save(false);
    }
}
