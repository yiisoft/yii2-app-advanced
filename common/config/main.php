<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache',
            //'class' => 'yii\caching\MemCache',
            //'useMemcached' => true,
        ],
        'authManager' => 'yii\rbac\DbManager',
    ],
];
