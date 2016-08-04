<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
        'id' => 'common',
        'basePath' => dirname(__DIR__),
        'components' => [
            'user' => [
                'class' => 'yii\web\User',
                'identityClass' => 'common\models\User',
            ],
        ],
    ]
);