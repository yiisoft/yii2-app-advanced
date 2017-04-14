<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases'        => [
        '@bower' => '@vendor/bower-asset',      # required for asset-packagist
        '@npm'   => '@vendor/npm-asset'         # required for asset-packagist
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'  => [
            'class'        => 'yii\rbac\DbManager'
        ],
        'i18n'         => [
            'translations' => [
                '*' => [
                    'class'                 => 'yii\i18n\DbMessageSource',
                    'forceTranslation'      => true,
                    'sourceLanguage'        => 'en_gb',
                    'sourceMessageTable'    => '{{%i18n_source_message}}',
                    'messageTable'          => '{{%i18n_message}}',
                    'on missingTranslation' => [ 'mobilejazz\yii2\cms\backend\modules\i18n\Module', 'missingTranslation' ],
                ],
            ],
        ],
        'encrypter'    => [
            'class'               => 'mobilejazz\yii2\cms\common\modules\encrypt\components\Encrypter',
            'globalPassword'      => 'changeme',
            'iv'                  => 'changeme',
            'useBase64Encoding'   => true,
            'use256BitesEncoding' => false,
        ],
    ],
];
