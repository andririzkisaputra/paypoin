<?php

use yii\db\Migration;

/**
 * Class m220131_041634_insert_user
 */
class m220131_041634_insert_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableUser = '{{%user}}';

        $this->insert($tableUser,array(
            'username'             => 'admin',
            'auth_key'             => Yii::$app->security->generateRandomString(),
            'password_hash'        => Yii::$app->security->generatePasswordHash('admin'),
            'password_reset_token' => NULL,
            'email'                => 'programmer@fasapay.co.id',
            'status'               => '10',
            'created_at'           => time(),
            'updated_at'           => time(),
        ));
    }
}
