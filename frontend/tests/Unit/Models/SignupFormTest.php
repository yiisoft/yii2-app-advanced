<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\SignupForm;
use frontend\tests\Support\UnitTester;
use Yii;
use yii\base\Security;
use yii\mail\MessageInterface;
use yii\symfonymailer\Message;

final class SignupFormTest extends Unit
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

    public function testCorrectSignup(): void
    {
        $model = new SignupForm(
            [
                'username' => 'some_username',
                'email' => 'some_email@example.com',
                'password' => 'some_password',
            ],
        );

        $user = $model->signup(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name);

        verify($user)->notEmpty();

        /** @var User $user */
        $user = $this->tester->grabRecord(
            User::class, 
            [
                'username' => 'some_username',
                'email' => 'some_email@example.com',
                'status' => User::STATUS_INACTIVE,
            ],
        );

        $this->tester->seeEmailIsSent();
        $mail = $this->tester->grabLastSentEmail();

        verify($mail)
            ->instanceOf(MessageInterface::class);
        verify($mail->getTo())
            ->arrayHasKey('some_email@example.com');
        verify($mail->getFrom())
            ->arrayHasKey(Yii::$app->params['supportEmail']);
        verify($mail->getSubject())
            ->equals('Account registration at ' . Yii::$app->name);
        verify($mail->toString())
            ->stringContainsString($user->verification_token);
    }

    public function testNotCorrectSignup(): void
    {
        $model = new SignupForm(
            [
                'username' => 'troy.becker',
                'email' => 'nicolas.dianna@hotmail.com',
                'password' => 'some_password',
            ],
        );

        verify($model->signup(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->empty();
        verify($model->getErrors('username'))
            ->notEmpty();
        verify($model->getErrors('email'))
            ->empty();
        verify($model->getFirstError('username'))
            ->equals('This username has already been taken.');

        $this->tester->dontSeeEmailIsSent();
    }

    public function testSignupWithExistingEmail(): void
    {
        $model = new SignupForm(
            [
                'username' => 'some_username',
                'email' => 'nicolas.dianna@hotmail.com',
                'password' => 'some_password',
            ],
        );

        $security = new class extends Security {
            public int $passwordHashCount = 0;

            public function generatePasswordHash($password, $cost = null)
            {
                $this->passwordHashCount++;

                return parent::generatePasswordHash($password, $cost);
            }
        };

        Yii::$app->set('security', $security);

        verify($model->signup(Yii::$app->mailer, Yii::$app->params['supportEmail'], Yii::$app->name))
            ->true();
        verify($model->hasErrors())
            ->false();
        verify($security->passwordHashCount)
            ->equals(1);

        $this->tester->dontSeeRecord(User::class, ['username' => 'some_username']);
        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        verify($mail)
            ->instanceOf(Message::class);
        verify($mail->getTo())
            ->arrayHasKey('nicolas.dianna@hotmail.com');
        verify($mail->getSubject())
            ->equals('Account registration at ' . Yii::$app->name);
        verify($mail->getSymfonyEmail()->getTextBody())
            ->stringContainsString('already belongs to your account');
    }
}
