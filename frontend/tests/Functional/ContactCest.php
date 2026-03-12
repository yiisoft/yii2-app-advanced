<?php

declare(strict_types=1);

namespace frontend\tests\Functional;

use frontend\tests\Support\FunctionalTester;

final class ContactCest
{
    public function _before(FunctionalTester $I): void
    {
        $I->amOnRoute('site/contact');
    }

    public function checkContact(FunctionalTester $I): void
    {
        $I->see('Contact us', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I): void
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contact us', 'h1');
        $I->seeValidationError('Name cannot be blank');
        $I->seeValidationError('Email cannot be blank');
        $I->seeValidationError('Subject cannot be blank');
        $I->seeValidationError('Body cannot be blank');
        $I->seeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I): void
    {
        $I->submitForm(
            '#contact-form', 
            [
                'ContactForm[name]' => 'tester',
                'ContactForm[email]' => 'tester.email',
                'ContactForm[subject]' => 'test subject',
                'ContactForm[body]' => 'test content',
                'ContactForm[verifyCode]' => 'testme',
            ],
        );
        $I->seeValidationError('Email is not a valid email address.');
        $I->dontSeeValidationError('Name cannot be blank');
        $I->dontSeeValidationError('Subject cannot be blank');
        $I->dontSeeValidationError('Body cannot be blank');
        $I->dontSeeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I): void
    {
        $I->submitForm(
            '#contact-form', 
            [
                'ContactForm[name]' => 'tester',
                'ContactForm[email]' => 'tester@example.com',
                'ContactForm[subject]' => 'test subject',
                'ContactForm[body]' => 'test content',
                'ContactForm[verifyCode]' => 'testme',
            ],
        );
        $I->seeEmailIsSent();
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
