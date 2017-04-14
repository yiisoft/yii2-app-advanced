<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'   => [
        'cmsfrontend'       => 'mobilejazz\yii2\cms\frontend\Module',
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '/mobilejazz/yii2-mj-cms/src/frontend/views' => [
                        '@app/views'
                    ],
                    '@mobilejazz/yii2/cms/frontend/views' => [
                        '@app/views'
                    ],
                    '@mobilejazz/yii2/cms/common/modules/webform/views' => [
                        '@app/views'
                    ],
                ]
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user'               => [
            'identityClass'   => 'mobilejazz\yii2\cms\common\models\User',
            'enableAutoLogin' => true,
        ],
        'assetManager'       => [
            'appendTimestamp' => true,
            'linkAssets'      => true
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
            'errorAction' => 'cmsfrontend/site/error',
        ],
        'urlManager'         => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                [
                    'class'   => 'mobilejazz\yii2\cms\frontend\components\FrontendUrlRules',
                    'baseUrl' => $params['baseUrl']
                ]
            ],
            'baseUrl' => $params['baseUrl']
        ],
        'urlManagerFrontend' => [
            'class' => 'mobilejazz\yii2\cms\frontend\components\FrontendUrlRules'
        ]
    ],
    'as locale'           => [
        'class'                   => 'mobilejazz\yii2\cms\common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true,
        'cookieName'              => '_frontendLocale'
    ],
    'params' => $params,
];
