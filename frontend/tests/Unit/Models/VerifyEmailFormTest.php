<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use common\models\User;
use frontend\models\VerifyEmailForm;
use frontend\tests\Support\UnitTester;
use yii\base\InvalidArgumentException;

final class VerifyEmailFormTest extends Unit
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

    public function testVerifyWrongToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class, 
            static function (): void {
                new VerifyEmailForm('');
            },
        );

        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            static function (): void {
                new VerifyEmailForm('notexistingtoken_1391882543');
            }
        );
    }

    public function testAlreadyActivatedToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class, 
            static function (): void {
                new VerifyEmailForm('already_used_token_1548675330');
            },
        );
    }

    public function testVerifyCorrectToken(): void
    {
        $model = new VerifyEmailForm('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');

        $user = $model->verifyEmail();

        verify($user)
            ->instanceOf(User::class);
        verify($user->username)
            ->equals('test.test');
        verify($user->email)
            ->equals('test@mail.com');
        verify($user->status)
            ->equals(User::STATUS_ACTIVE);
        verify($user->validatePassword('Test1234'))
            ->true();
    }
}
