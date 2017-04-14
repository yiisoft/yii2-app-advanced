<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'cmsbackend'              => [
            'class'         => 'mobilejazz\yii2\cms\backend\Module',
            'configMerge'   => [
                'components' => [
                    'urlManagerFrontend'    => [
                        'baseUrl'   => $params['baseUrl']
                    ]
                ]
            ]
        ],
        'gridview'    => [
            'class' => '\kartik\grid\Module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user'               => [
            'identityClass'   => 'mobilejazz\yii2\cms\common\models\User',                      # Shared with the frontend
            'enableAutoLogin' => true
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'view'     => [
            'theme' => [
                'basePath'  => '@webroot',
                'baseUrl'   => '@web',
                'pathMap'   => [
                    '@app/views/layouts' => [                               # Use default layouts from backend
                        '/Development/yii2-mj-cms/src/backend/views/layouts',
                        '@mobilejazz/yii2/cms/backend/views/layouts'
                    ],
                    '/Development/yii2-mj-cms/src/backend/views' => [        # Allow for overriding all other backend views locally, local development
                        '@app/views'
                    ],
                    '@mobilejazz/yii2/cms/backend/views' => [               # Allow for overriding all other backend views locally, when used as a remote library
                        '@app/views'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'cmsbackend/site/error',
        ],
        'urlManager'         => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                '/'     => 'cmsbackend/site/index',
                [
                        'class' => 'mobilejazz\yii2\cms\backend\components\BackendUrlRules'           # Provides some convenience path mappings
                ]
            ],
            'baseUrl'   => $params['adminBaseUrl']
        ],
    ],
    'as locale'           => [
        'class'                   => 'mobilejazz\yii2\cms\common\behaviors\LocaleBehavior',     # For setting the language
        'enablePreferredLanguage' => true,
        'cookieName'              => '_backendLocale'
    ],
    'params' => $params,
];
