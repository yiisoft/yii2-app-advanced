<?php

$exts = dirname(dirname(__DIR__)) . '/extensions';
return [
    'bootstrap' => [
//        'debug',
//        'gii',
        'admin'
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'bizmodel' => ['class' => 'biz\gii\generators\model\Generator'],
                'crud' => [
                    'class' => 'yii\gii\generators\crud\Generator',
                    'templates'=>[
                        'netbeans' => '@biz/gii/generators/crud/netbeans'
                    ]
                ]
            ]
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'positionMenu' => 'left',
            'allowActions' => [
//                '*'
            ],
            'items'=>[
                'assigment'=>[
                    'idField'=>'id',
                    'usernameField'=>'username'
                ]
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
        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
        ],
        'view' => [
//            'theme' => 'biz\adminlte\Theme',
        ],
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager',
        ],
    ],
    'as client' => 'mdm\clienttools\ClientBehavior',
];
