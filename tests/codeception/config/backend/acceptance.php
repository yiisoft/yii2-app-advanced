<?php
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', __DIR__ .  '/../../../..');

/**
 * Application configuration for backend acceptance tests
 */
return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/main.php'),
    require(YII_APP_BASE_PATH . '/common/config/main-local.php'),
    require(YII_APP_BASE_PATH . '/backend/config/main.php'),
    require(YII_APP_BASE_PATH . '/backend/config/main-local.php'),
    require(__DIR__ . '/../config.php'),
    require(__DIR__ . '/../config-local.php'),
    require(__DIR__ . '/../acceptance.php'),
    require(__DIR__ . '/config.php'),
    [
    ]
);
