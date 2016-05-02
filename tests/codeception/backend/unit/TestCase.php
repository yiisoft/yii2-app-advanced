<?php

namespace tests\codeception\backend\unit;

use yii\codeception\TestCase as TestCaseOld;

class TestCase extends TestCaseOld
{
    public $appConfig = '@tests/codeception/config/backend/unit.php';
}
