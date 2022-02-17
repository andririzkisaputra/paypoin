<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'pulsa' => [
            'class' => 'frontend\modules\pulsa\Modules'
        ],
        'paket-data' => [
            'class' => 'frontend\modules\paketdata\Modules'
        ],
        'tagihan-listrik' => [
            'class' => 'frontend\modules\tagihanlistrik\Modules'
        ],
        'token-listrik' => [
            'class' => 'frontend\modules\tokenlistrik\Modules'
        ],
        'telkom' => [
            'class' => 'frontend\modules\telkom\Modules'
        ],
        'angsuran' => [
            'class' => 'frontend\modules\angsuran\Modules'
        ],
        'e-money' => [
            'class' => 'frontend\modules\emoney\Modules'
        ],
        'pdam' => [
            'class' => 'frontend\modules\pdam\Modules'
        ],
        'games' => [
            'class' => 'frontend\modules\games\Modules'
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
