<?php
/**
 * Application config for common unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/main.php'),
    require(YII_APP_BASE_PATH . '/common/config/main-local.php'),
    require(__DIR__ . '/../config.php'),
    require(__DIR__ . '/../config-local.php'),
    require(__DIR__ . '/../unit.php'),
    [
        'id' => 'app-common',
        'basePath' => dirname(__DIR__),
    ]
);
