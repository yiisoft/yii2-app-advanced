<?php

$exts = dirname(dirname(__DIR__)) . '/extensions';
return [
    'bootstrap' => [
    //'debug',
    //'gii',
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => 'yii\gii\Module',
        'master' => 'biz\master\Module',
        'inventory' => 'biz\inventory\Module',
        'accounting' => 'biz\accounting\Module',
        'purchase' => 'biz\purchase\Module',
        'sales' => 'biz\sales\Module',
    ],
    'components' => [
        'user' => [
            'as info' => 'app\tools\UserInfo',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'mdm\tools\MongoTarget',
                    'levels' => ['info'],
                    'categories' => ['application*'],
                ],
            ],
        ],
        'hooks' => 'app\tools\Hooks',
        'urlManager' => [
        //'enablePrettyUrl' => true,
        //'showScriptName' => false,
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/error',
            'site/manifest',
        ]],
    'as clientId' => 'mdm\tools\ClientKey',
];
