<?php

namespace tests\codeception\common\unit;

use yii\codeception\TestCase as TestCaseOld;

/**
 * @inheritdoc
 */
class TestCase extends TestCaseOld
{
    public $appConfig = '@tests/codeception/config/common/unit.php';
}
