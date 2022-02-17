<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use common\models\FileUpload;
use yii\helpers\ArrayHelper;

/**
 * Description of FileUploadForm
 *
 * @author andri
 */
class FileUploadForm extends FileUpload
{
    public $file_image;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [
                ['file_image'], 
                'file', 
                'skipOnEmpty' => true, 
                'extensions' =>  ['png', 'jpg', 'jpeg', 'bmp'], 
                'maxFiles' => 1
            ],
            [['session_upload_id'], 'integer'],
            [['file_name'], 'string'],
        ]);
    }
    
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => [
                'file_image',
            ],
        ];
    }  
    
}
