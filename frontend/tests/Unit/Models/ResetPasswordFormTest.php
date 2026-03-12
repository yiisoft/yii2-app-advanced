<?php

declare(strict_types=1);

namespace frontend\tests\Unit\Models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\ResetPasswordForm;
use frontend\tests\Support\UnitTester;
use yii\base\InvalidArgumentException;

final class ResetPasswordFormTest extends Unit
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

    public function testResetWrongToken(): void
    {
        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            static function (): void {
                new ResetPasswordForm('');
            },
        );

        $this->tester->expectThrowable(
            InvalidArgumentException::class,
            static function (): void {
                new ResetPasswordForm('notexistingtoken_1391882543');
            },
        );
    }

    public function testResetCorrectToken(): void
    {
        $user = $this->tester->grabFixture('user', 0);

        $form = new ResetPasswordForm($user['password_reset_token']);

        verify($form->resetPassword())
            ->notEmpty();
    }
}
