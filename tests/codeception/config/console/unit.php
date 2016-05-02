<?php
/**
 * Application configuration for console unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/main.php'),
    require(YII_APP_BASE_PATH . '/common/config/main-local.php'),
    require(YII_APP_BASE_PATH . '/console/config/main.php'),
    require(YII_APP_BASE_PATH . '/console/config/main-local.php'),
    require(__DIR__ . '/../config.php'),
    require(__DIR__ . '/../config-local.php'),
    require(__DIR__ . '/../unit.php'),
    [
    ]
);
