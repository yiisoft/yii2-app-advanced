<?php

declare(strict_types=1);

namespace frontend\tests\Functional;

use common\models\User;
use frontend\tests\Support\FunctionalTester;

final class SignupCest
{
    protected string $formId = '#form-signup';

    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I): void
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function signupWithWrongEmail(FunctionalTester $I): void
    {
        $I->submitForm(
            $this->formId,
            [
                'SignupForm[username]' => 'tester',
                'SignupForm[email]' => 'ttttt',
                'SignupForm[password]' => 'tester_password',
            ]
        );
        $I->dontSee('Username cannot be blank.', '.invalid-feedback');
        $I->dontSee('Password cannot be blank.', '.invalid-feedback');
        $I->see('Email is not a valid email address.', '.invalid-feedback');
    }

    public function signupSuccessfully(FunctionalTester $I): void
    {
        $I->submitForm(
            $this->formId, 
            [
                'SignupForm[username]' => 'tester',
                'SignupForm[email]' => 'tester.email@example.com',
                'SignupForm[password]' => 'tester_password',
            ],
        );

        $I->seeRecord(
            User::class, 
            [
                'username' => 'tester',
                'email' => 'tester.email@example.com',
                'status' => User::STATUS_INACTIVE,
            ],
        );

        $I->seeEmailIsSent();
        $I->see('Thank you for registration. Please check your inbox for verification email.');
    }
}
