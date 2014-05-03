<?php

$exts = dirname(dirname(__DIR__)) . '/extensions';
return [
    'bootstrap' => [
//        'debug',
//        'gii',
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'bizmodel' => ['class' => 'biz\gii\generators\model\Generator']
            ]
        ],
        'master' => 'biz\master\Module',
        'inventory' => 'biz\inventory\Module',
        'accounting' => 'biz\accounting\Module',
        'purchase' => 'biz\purchase\Module',
        'sales' => 'biz\sales\Module',
    ],
    'components' => [
        'user' => [
            'as info' => 'biz\behaviors\UserBehavior',
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
        'hooks' => 'biz\tools\Hooks',
        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
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
    'as appcache' => 'mdm\tools\AppCache',
];
