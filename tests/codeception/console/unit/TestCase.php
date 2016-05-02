<?php

namespace tests\codeception\console\unit;

use yii\codeception\TestCase as TestCaseOld;

/**
 * @inheritdoc
 */
class TestCase extends TestCaseOld
{
    public $appConfig = '@tests/codeception/config/console/unit.php';
}
