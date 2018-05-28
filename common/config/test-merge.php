<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php',
    require __DIR__ . '/../config/test.php',
    require __DIR__ . '/../config/test-local.php'
);