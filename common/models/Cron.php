<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cron}}".
 *
 * @property int $id
 * @property string $code
 * @property string $c1
 * @property string $c2
 * @property string|null $c3
 */
class Cron extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cron}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'c1', 'c2', 'c3'], 'string', 'max' => 255],
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
            'c1' => 'C1',
            'c2' => 'C2',
            'c3' => 'C3',
        ];
    }
}
