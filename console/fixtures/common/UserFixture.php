<?php

namespace console\fixtures\common;

use yii\test\ActiveFixture;

/**
 * Class User Fixture represents a fixture backed up by User ActiveRecord model
 * Note: To apply this fixture run in console `php yii fixture/load User`
 * @see http://www.yiiframework.com/doc-2.0/guide-test-fixtures.html
 */
class UserFixture extends ActiveFixture
{
    /**
     * The AR model class associated with this fixture.
     * @var string 
     */
    public $modelClass = 'common\models\User';
    /**
     * Can be skipped to set. 
     * @see ActiveFixture::$dataFile
     * @var string
     */
    public $dataFile = '@console/fixtures/common/data/user.php';
}