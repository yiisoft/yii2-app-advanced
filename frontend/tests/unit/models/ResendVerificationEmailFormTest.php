<?php

namespace frontend\tests\unit\models;


use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\ResendVerificationEmailForm;
use yii\mail\MessageInterface;

class ResendVerificationEmailFormTest extends Unit
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

    public function testWrongEmailAddress()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => 'aaa@bbb.cc'
        ];

        if (PHP_VERSION_ID >= 70400) {
            expect($model->validate())->toBeFalse();
            expect($model->hasErrors())->toBeTrue();
            expect($model->getFirstError('email'))->toBe('There is no user with this email address.');
            return;
        }
        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('There is no user with this email address.');
    }

    public function testEmptyEmailAddress()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => ''
        ];

        if (PHP_VERSION_ID >= 70400) {
            expect($model->validate())->toBeFalse();
            expect($model->hasErrors())->toBeTrue();
            expect($model->getFirstError('email'))->toBe('Email cannot be blank.');
            return;
        }
        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('Email cannot be blank.');
    }

    public function testResendToActiveUser()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => 'test2@mail.com'
        ];

        if (PHP_VERSION_ID >= 70400) {
            expect($model->validate())->toBeFalse();
            expect($model->hasErrors())->toBeTrue();
            expect($model->getFirstError('email'))->toBe('There is no user with this email address.');
            return;
        }
        expect($model->validate())->false();
        expect($model->hasErrors())->true();
        expect($model->getFirstError('email'))->equals('There is no user with this email address.');
    }

    public function testSuccessfullyResend()
    {
        $model = new ResendVerificationEmailForm();
        $model->attributes = [
            'email' => 'test@mail.com'
        ];

        if (PHP_VERSION_ID >= 70400) {
            expect($model->validate())->toBeTrue();
            expect($model->hasErrors())->toBeFalse();

            expect($model->sendEmail())->toBeTrue();
        } else {
            expect($model->validate())->true();
            expect($model->hasErrors())->false();

            expect($model->sendEmail())->true();
        }
        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        if (PHP_VERSION_ID >= 70400) {
            expect($mail)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
            expect($mail->getTo())->arrayToHaveKey('test@mail.com');
            expect($mail->getFrom())->arrayToHaveKey(\Yii::$app->params['supportEmail']);
            expect($mail->getSubject())->toBe('Account registration at ' . \Yii::$app->name);
            expect($mail->toString())->stringToContainString('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
            return;
        }
        expect('valid email is sent', $mail)->isInstanceOf('yii\mail\MessageInterface');
        expect($mail->getTo())->hasKey('test@mail.com');
        expect($mail->getFrom())->hasKey(\Yii::$app->params['supportEmail']);
        expect($mail->getSubject())->equals('Account registration at ' . \Yii::$app->name);
        expect($mail->toString())->stringContainsString('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
    }
}
