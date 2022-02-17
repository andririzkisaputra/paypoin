<?php

namespace frontend\modules\pulsa;

/**
 * brwne module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\pulsa\controllers';
    public $modelsNamespace     = 'frontend\modules\pulsa\models';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
