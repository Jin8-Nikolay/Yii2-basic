<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'sourceLanguage'=>'ua',
    'language'=>'ua',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'daa87-mfDtVg_9EyX5xAp7B7N7UT2xjT',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'i18n' => [
            'translations' => [
                'admin' =>[
                    'class'=>'yii\i18n\PhpMessageSource',
                    'basePath'=>'@app/messages',
                    'fileMap'=>[
                        'admin'=>'admin.php'
                    ]
                ],
                'frontend' =>[
                    'class'=>'yii\i18n\PhpMessageSource',
                    'basePath'=>'@app/messages',
                    'fileMap'=>[
                        'admin'=>'frontend.php'
                    ]
                ],
                'app *' => [
                    'class' => 'yii \ i18n \ PhpMessageSource',
                    'basePath' => '@ common / messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app / error' => 'error.php',
                    ],
                ],
            ],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'thumbs/<path:.*>' => 'mm/thumb/thumb',
                'mm/api/list' => 'mm/api/list',
                'mm/api/upload' => 'mm/api/upload',
                'mm/api/download' => 'mm/api/download',
                'nova-poshta/get-cities/'=>'nova-poshta/get-cities',
            ],
        ],
        'fs' => [
            'class' => 'creocoder\flysystem\LocalFilesystem',
            'path' => '@webroot/upload',
        ],

    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'mm' => [
            'class' => 'iutbay\yii2\mm\Module',
        ],
    ],
    'params' => $params,





];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
