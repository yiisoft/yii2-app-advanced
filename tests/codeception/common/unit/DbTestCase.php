<?php

namespace tests\codeception\common\unit;

use yii\codeception\DbTestCase as DbTestCaseOld;

/**
 * @inheritdoc
 */
class DbTestCase extends DbTestCaseOld
{
    public $appConfig = '@tests/codeception/config/common/unit.php';
}
