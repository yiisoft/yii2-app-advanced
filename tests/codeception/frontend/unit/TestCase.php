<?php

namespace tests\codeception\frontend\unit;

use yii\codeception\TestCase as TestCaseOld;

/**
 * @inheritdoc
 */
class TestCase extends TestCaseOld
{
    public $appConfig = '@tests/codeception/config/frontend/unit.php';
}
