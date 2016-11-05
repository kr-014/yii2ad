<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'rokorolov\parus\admin\Module',
            'config' => [
                'additionalComponents' => [
                    'formatter' => [
                        'class' => 'yii\i18n\Formatter',
                        'defaultTimeZone' => 'Europe/Riga',
                        'timeZone' => 'Europe/Riga',
                        'dateFormat' => 'php:d-m-Y',
                        'datetimeFormat' => 'php:d-m-Y H:i:s',
                        'timeFormat' => 'php:H:i:s'
                    ],
                ],
            ],
            'blogConfig' => [
                'post.imageTransformations' => [
                    ['postfix' => 'large', 'width' => 900, 'height' => 400, 'method' => 'crop']
                ],
            ],
            'fileManagerConfig' => [
                'responsiveFileManagerSrc' => '/plugins/responsivefilemanager/dialog.php?type=0',
                'privateKey' => 'ioqopwdklm'
            ]
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nEsyPAtFSu5JVgXmicCaAEUgp-BnoS-3',
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
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['logic'],
                    'logFile' => '@runtime/logs/logic.log',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'site/<_a:(about|contact|captcha|login)>' => 'site/<_a>',
                'admin' => 'admin/dashboard/dashboard/index',
                [
                    'class' => 'rokorolov\parus\menu\components\PageUrlRule',
                ],
                [
                    'class' => 'rokorolov\parus\menu\components\CategoryUrlRule',
                ],
                [
                    'class' => 'rokorolov\parus\menu\components\PostUrlRule',
                ]
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
