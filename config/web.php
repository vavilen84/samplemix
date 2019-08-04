<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'fixed',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'mzXxdQH5AgvxiDDhPgmlK4NLENF4VH4n',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.com',
                'username' => Yii::$app->params['mailer_username'],
                'password' => Yii::$app->params['mailer_password'],
                'port' => 465,
                'encryption' => 'ssl'
            ]
        ],
        'user' => [
            'loginUrl' => '/user/login',
            'identityClass' => 'app\models\db\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
        'db' => $db,
        'autocomplete' => [
            'class' => 'app\components\autocomplete\Application',
        ],
        'base' => [
            'class' => 'app\components\Base',
        ],
        'baseComponentData' => [
            'class' => 'app\components\baseComponentData',
        ],
        'console' => [
            'class' => 'app\components\Console',
        ],
        'assetManager' => [
            'bundles' => [
                'all' => [
                    'class' => 'yii\web\AssetBundle',
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'depends' => [
                        'yii\web\YiiAsset',
                        'yii\bootstrap\BootstrapAsset',
                    ]
                ],
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller/<action>' => '<controller>/<action>',
//                '/' => '/frontend/index/index',
//                '/user/register' => '/frontend/user/register',
//                '/user/profile' => '/frontend/user/profile',
//                '/user/login' => '/frontend/user/login',
//                '/user/logout' => '/frontend/user/logout',
//                '/mix/index' => '/frontend/mix/index',
//                '/mix/create' => '/frontend/mix/create',
//                '/mix/update' => '/frontend/mix/update',
//                '/collection/index' => '/frontend/collection/index',
//                '/collection/create' => '/frontend/collection/create',
//                '/collection/update' => '/frontend/collection/update',
//                '/collection/delete' => '/frontend/collection/update',
//                '/sample/index' => '/frontend/sample/index',
//                '/admin' => '/backend/index/index',
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '10.0.77.1'],
    ];
}

return $config;
