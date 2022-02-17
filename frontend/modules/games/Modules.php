<?php

namespace frontend\modules\games;

/**
 * brwne module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\games\controllers';
    public $modelsNamespace     = 'frontend\modules\games\models';


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
