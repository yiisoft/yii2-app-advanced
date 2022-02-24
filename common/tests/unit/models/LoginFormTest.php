<?php

namespace common\tests\unit\models;

use Yii;
use common\models\LoginForm;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        if (PHP_VERSION_ID >= 70400) {
            expect($model->login())->toBeFalse('model should not login user');
            expect(Yii::$app->user->isGuest)->toBeTrue('user should not be logged in');
            return;
        }
        expect('model should not login user', $model->login())->false();
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        if (PHP_VERSION_ID >= 70400) {
            expect($model->login())->toBeFalse('model should not login user');
            expect($model->errors)->arrayToHaveKey('password', 'error message should be set');
            expect(Yii::$app->user->isGuest)->toBeTrue('user should not be logged in');
            return;
        }
        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);

        if (PHP_VERSION_ID >= 70400) {
            expect($model->login())->toBeTrue('model should login user');
            expect($model->errors)->arrayNotToHaveKey('password', 'error message should not be set');
            expect(Yii::$app->user->isGuest)->toBeFalse('user should be logged in');
            return;
        }
        expect('model should login user', $model->login())->true();
        expect('error message should not be set', $model->errors)->hasntKey('password');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
}
