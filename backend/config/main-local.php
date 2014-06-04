<?php

$exts = dirname(dirname(__DIR__)) . '/extensions';
return [
    'bootstrap' => [
        'debug',
//        'gii',
        'admin'
    ],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'bizmodel' => ['class' => 'biz\gii\generators\model\Generator']
            ]
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'positionMenu' => 'left',
            'allowActions' => [
                '*'
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
//        'log' => [
//            'targets' => [
//                [
//                    'class' => 'mdm\logger\MongoTarget',
//                    'levels' => ['info'],
//                    'categories' => ['application*'],
//                ],
//            ],
//        ],
        'hooks' => [
            'class' => 'biz\base\Hooks',
            'hooksPath' => '@biz/hooks',
            'hooksNamespace' => 'biz\hooks',
        ],
        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
        ],
        'view' => [
//            'theme' => [
//                'pathMap' => ['@app/views' => '@biz/adminlte/views'],
//            ],
        ]
    ],
    'as client' => 'mdm\clienttools\ClientBehavior',
];
