<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
        'message' => [
            'class' => '@mobilejazz\yii2\cms\console\controllers\ExtendedMessageController'
        ],
        'migrate'=>[
            'class'=>'fishvision\migrate\controllers\MigrateController',
            'autoDiscover' => true,
            'migrationPaths'=>[
                '@vendor/yiisoft/yii2/rbac/migrations',
                '@vendor/mobilejazz/yii2-mj-cms/src/console/migrations',
                '@console/migrations'
            ]
        ]
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
