<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\tests\Support\UnitTester;
use Yii;
use yii\mail\MessageInterface;

final class PasswordResetRequestFormTest extends Unit
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

    public function testSendMessageWithWrongEmailAddress(): void
    {
        $model = new PasswordResetRequestForm();

        $model->email = 'not-existing-email@example.com';

        verify($model->sendEmail(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->false();
    }

    public function testNotSendEmailsToInactiveUser(): void
    {
        $user = $this->tester->grabFixture('user', 1);

        $model = new PasswordResetRequestForm();

        $model->email = $user['email'];

        verify($model->sendEmail(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->false();
    }

    public function testSendEmailSuccessfully(): void
    {
        $userFixture = $this->tester->grabFixture('user', 0);

        $model = new PasswordResetRequestForm();

        $model->email = $userFixture['email'];

        $user = User::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        verify($model->sendEmail(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->notEmpty();
        verify($user->password_reset_token)
            ->notEmpty();

        $emailMessage = $this->tester->grabLastSentEmail();

        verify($emailMessage)
            ->instanceOf(MessageInterface::class);
        verify($emailMessage->getTo())
            ->arrayHasKey($model->email);
        verify($emailMessage->getFrom())
            ->arrayHasKey(Yii::$app->params['supportEmail']);
    }
}
