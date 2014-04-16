<?php

$exts = dirname(dirname(__DIR__)) . '/extensions';
return [
    'preload' => [
    //'debug',
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
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/error',
            'site/manifest'
        ]],
    'as clientId' => 'backend\components\ClientKey'
];
