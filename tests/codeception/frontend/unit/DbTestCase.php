<?php

namespace tests\codeception\frontend\unit;

use yii\codeception\DbTestCase as DbTestCaseOld;

/**
 * @inheritdoc
 */
class DbTestCase extends DbTestCaseOld
{
    public $appConfig = '@tests/codeception/config/frontend/unit.php';
}
