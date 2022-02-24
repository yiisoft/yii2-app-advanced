<?php

namespace frontend\tests\unit\models;

use Yii;
use frontend\models\PasswordResetRequestForm;
use common\fixtures\UserFixture as UserFixture;
use common\models\User;
use yii\mail\MessageInterface;

class PasswordResetRequestFormTest extends \Codeception\Test\Unit
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

    public function testSendMessageWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        if (PHP_VERSION_ID >= 70400) {
            expect($model->sendEmail())->toBeFalse();
            return;
        }
        expect_not($model->sendEmail());
    }

    public function testNotSendEmailsToInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        if (PHP_VERSION_ID >= 70400) {
            expect($model->sendEmail())->toBeFalse();
            return;
        }
        expect_not($model->sendEmail());
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('user', 0);
        
        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        if (PHP_VERSION_ID >= 70400) {
            expect($model->sendEmail())->toBeTrue();
            expect($user->password_reset_token)->toBeString();
        } else {
            expect_that($model->sendEmail());
            expect_that($user->password_reset_token);
        }

        $emailMessage = $this->tester->grabLastSentEmail();
        if (PHP_VERSION_ID >= 70400) {
            expect($emailMessage)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
            expect($emailMessage->getTo())->arrayToHaveKey($model->email);
            expect($emailMessage->getFrom())->arrayToHaveKey(Yii::$app->params['supportEmail']);
            return;
        }
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($model->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['supportEmail']);
    }
}
