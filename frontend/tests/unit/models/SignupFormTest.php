<?php

namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use frontend\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $user = $model->signup();
        if (PHP_VERSION_ID >= 70400) {
            expect($user)->toBeTrue();
        } else {
            expect($user)->true();
        }

        /** @var \common\models\User $user */
        $user = $this->tester->grabRecord('common\models\User', [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);

        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        if (PHP_VERSION_ID >= 70400) {
            expect($mail)->toBeInstanceOf('yii\mail\MessageInterface');
            expect($mail->getTo())->arrayToHaveKey('some_email@example.com');
            expect($mail->getFrom())->arrayToHaveKey(\Yii::$app->params['supportEmail']);
            expect($mail->getSubject())->toBe('Account registration at ' . \Yii::$app->name);
            expect($mail->toString())->stringToContainString($user->verification_token);
            return;
        }
        expect($mail)->isInstanceOf('yii\mail\MessageInterface');
        expect($mail->getTo())->hasKey('some_email@example.com');
        expect($mail->getFrom())->hasKey(\Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->equals('Account registration at ' . \Yii::$app->name);
        expect($mail->toString())->stringContainsString($user->verification_token);
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        if (PHP_VERSION_ID >= 70400) {
            expect($model->signup())->toBeNull();
            expect($model->getErrors('username'))->notToBeEmpty();
            expect($model->getErrors('email'))->notToBeEmpty();

            expect($model->getFirstError('username'))
                ->toBe('This username has already been taken.');
            expect($model->getFirstError('email'))
                ->toBe('This email address has already been taken.');
            return;
        }
        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}
