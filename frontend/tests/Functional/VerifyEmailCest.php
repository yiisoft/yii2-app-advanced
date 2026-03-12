<?php

declare(strict_types=1);

namespace frontend\tests\Functional;

use common\fixtures\UserFixture;
use common\models\User;
use frontend\tests\Support\FunctionalTester;

final class VerifyEmailCest
{
    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ];
    }

    public function checkEmptyToken(FunctionalTester $I): void
    {
        $I->amOnRoute('site/verify-email', ['token' => '']);
        $I->canSee('400', 'h1');
        $I->canSee('Verify email token cannot be blank.', 'h2');
    }

    public function checkInvalidToken(FunctionalTester $I): void
    {
        $I->amOnRoute('site/verify-email', ['token' => 'wrong_token']);
        $I->canSee('400', 'h1');
        $I->canSee('Wrong verify email token.', 'h2');
    }

    public function checkNoToken(FunctionalTester $I): void
    {
        $I->amOnRoute('site/verify-email');
        $I->canSee('400', 'h1');
        $I->canSee('Missing required parameters: token', 'h2');
    }

    public function checkAlreadyActivatedToken(FunctionalTester $I): void
    {
        $I->amOnRoute('site/verify-email', ['token' => 'already_used_token_1548675330']);
        $I->canSee('400', 'h1');
        $I->canSee('Wrong verify email token.', 'h2');
    }

    public function checkSuccessVerification(FunctionalTester $I): void
    {
        $I->amOnRoute('site/verify-email', ['token' => '4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330']);
        $I->canSee('Your email has been confirmed!');
        $I->canSee('Build with Yii Framework', 'h1');
        $I->dontSeeLink('Logout (test.test)');
        $I->seeRecord(
            User::class,
            [
                'username' => 'test.test',
                'email' => 'test@mail.com',
                'status' => User::STATUS_ACTIVE,
            ],
        );
    }
}
