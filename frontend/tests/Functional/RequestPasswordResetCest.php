<?php

declare(strict_types=1);

namespace frontend\tests\Functional;

use common\fixtures\UserFixture;
use frontend\tests\Support\FunctionalTester;

final class RequestPasswordResetCest
{
    protected string $formId = '#request-password-reset-form';
    protected string $successMessage = 'If an account with this email address exists, you will receive an email with further instructions.';

    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('/site/request-password-reset');
    }

    protected function formParams(string $email): array
    {
        return [
            'PasswordResetRequestForm[email]' => $email,
        ];
    }

    public function checkEmptyField(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, $this->formParams(''));
        $I->seeValidationError('Email cannot be blank.');
    }

    public function checkWrongEmailFormat(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, $this->formParams('abcd.com'));
        $I->seeValidationError('Email is not a valid email address.');
    }

    public function checkUnknownEmail(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, $this->formParams('wrong@email.com'));
        $I->dontSeeEmailIsSent();
        $I->dontSee('There is no user with this email address.');
        $I->see($this->successMessage);
    }

    public function checkInactiveUserEmail(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, $this->formParams('test@mail.com'));
        $I->dontSeeEmailIsSent();
        $I->see($this->successMessage);
    }

    public function checkSendSuccessfully(FunctionalTester $I): void
    {
        $I->submitForm($this->formId, $this->formParams('test2@mail.com'));
        $I->seeEmailIsSent();
        $I->see($this->successMessage);
    }
}
