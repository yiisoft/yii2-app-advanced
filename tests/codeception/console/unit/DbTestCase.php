<?php

namespace tests\codeception\console\unit;

use yii\codeception\DbTestCase as DbTestCaseOld;

/**
 * @inheritdoc
 */
class DbTestCase extends DbTestCaseOld
{
    public $appConfig = '@tests/codeception/config/console/unit.php';
}
