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
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log', 'maintenanceMode'],

    'language' => 'ru-RU',
    'sourceLanguage' => 'ru',

    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],

    'components' => [
        'maintenanceMode' => [
            'class' => 'brussens\maintenance\MaintenanceMode',
            // Page title
            'title' => 'Sorry!',

            // Mode status
            //'enabled' => true,

            // Show message
            'message' => 'We are updating site now. Please wait for some time',

            /*// Allowed user names
            'users' => [
                'BrusSENS',
            ],*/

            // Allowed roles
            'roles' => [
                'admin',
            ],

            // Allowed IP addresses
            /*'ips' => [
                '127.0.0.1',
            ],*/

            // Allowed URLs
            'urls' => [
                'site/login',
                'login',
            ],

            // Layout path
//            'layoutPath' => '@web/maintenance/layout',

            // View path
//            'viewPath' => '@web/maintenance/view',

            // User name attribute name
            'usernameAttribute' => 'email',

            // HTTP Status Code
            'statusCode' => 503,

            //Retry-After header
            'retryAfter' => 120 //or Wed, 21 Oct 2015 07:28:00 GMT for example
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages', // if advanced application, set @frontend/messages
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
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
                '<_c:(\w|-)+>' => '<_c>/index',
                '<_c:(\w|-)+>/<id:\d+>' => '<_c>/view',
                '<_c:(\w|-)+>/<_a:(\w|-)+>/<id:\d+>' => '<_c>/<_a>',
                '<_c:(\w|-)+>/<_a:(\w|-)+>' => '<_c>/<_a>',
            ],
        ],

    ],
    'params' => $params,
];
