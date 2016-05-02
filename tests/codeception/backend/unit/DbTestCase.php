<?php

namespace tests\codeception\backend\unit;

use yii\codeception\DbTestCase as DbTestCaseOld;

class DbTestCase extends DbTestCaseOld
{
    public $appConfig = '@tests/codeception/config/backend/unit.php';
}
