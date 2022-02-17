<?php

namespace frontend\modules\pdam;

/**
 * brwne module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\pdam\controllers';
    public $modelsNamespace     = 'frontend\modules\pdam\models';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
