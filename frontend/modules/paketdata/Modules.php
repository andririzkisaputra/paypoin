<?php

namespace frontend\modules\paketdata;

/**
 * brwne module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\paketdata\controllers';
    public $modelsNamespace     = 'frontend\modules\paketdata\modelsNamespace';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
