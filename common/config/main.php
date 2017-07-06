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
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'urlManagerFrontEnd' =>[
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'=>false,
            'baseUrl' => SITE_URL,
            //'class'=>'frontend\components\LangUrlManager',
            'rules'=> require(dirname(__FILE__).'/_urls.php')
        ],
    ],
    'modules' => [
        'noty' => [
            'class' => 'lo\modules\noty\Module',
        ],
    ],
];
