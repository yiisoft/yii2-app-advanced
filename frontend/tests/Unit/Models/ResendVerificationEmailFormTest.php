<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\ResendVerificationEmailForm;
use frontend\tests\Support\UnitTester;
use Yii;
use yii\mail\MessageInterface;

final class ResendVerificationEmailFormTest extends Unit
{
    protected UnitTester $tester;

    public function _before(): void
    {
        $this->tester->haveFixtures(
            [
                'user' => [
                    'class' => UserFixture::class,
                    'dataFile' => codecept_data_dir() . 'user.php',
                ],
            ],
        );
    }

    public function testWrongEmailAddress(): void
    {
        $model = new ResendVerificationEmailForm();

        $model->attributes = ['email' => 'aaa@bbb.cc'];

        verify($model->validate())
            ->false();
        verify($model->hasErrors())
            ->true();
        verify($model->getFirstError('email'))
            ->equals('There is no user with this email address.');
    }

    public function testEmptyEmailAddress(): void
    {
        $model = new ResendVerificationEmailForm();

        $model->attributes = ['email' => ''];

        verify($model->validate())
            ->false();
        verify($model->hasErrors())
            ->true();
        verify($model->getFirstError('email'))
            ->equals('Email cannot be blank.');
    }

    public function testResendToActiveUser(): void
    {
        $model = new ResendVerificationEmailForm();

        $model->attributes = ['email' => 'test2@mail.com'];

        verify($model->validate())
            ->false();
        verify($model->hasErrors())
            ->true();
        verify($model->getFirstError('email'))
            ->equals('There is no user with this email address.');
    }

    public function testSuccessfullyResend(): void
    {
        $model = new ResendVerificationEmailForm();

        $model->attributes = ['email' => 'test@mail.com'];

        verify($model->validate())
            ->true();
        verify($model->hasErrors())
            ->false();
        verify($model->sendEmail(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->true();

        $this->tester->seeEmailIsSent();
        $mail = $this->tester->grabLastSentEmail();

        verify($mail)->instanceOf(MessageInterface::class);
        verify($mail->getTo())
            ->arrayHasKey('test@mail.com');
        verify($mail->getFrom())
            ->arrayHasKey(Yii::$app->params['supportEmail']);
        verify($mail->getSubject())
            ->equals('Account registration at ' . Yii::$app->name);
        verify($mail->toString())
            ->stringContainsString('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
    }
}
