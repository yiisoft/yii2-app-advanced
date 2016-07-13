<?php

namespace tests\codeception\frontend\acceptance;

use tests\codeception\frontend\AcceptanceTester;
use tests\codeception\frontend\_pages\ContactPage;

class ContactCest
{
    
    function _before(AcceptanceTester $I, ContactPage $contactPage)
    {
        $I->amOnPage($contactPage->getUrl());
    }

    public function checkOpen(AcceptanceTester $I)
    {
        $I->expectTo('see page content');

        $I->see('Contact', 'h1');
    }

    public function checkEmpty(AcceptanceTester $I, ContactPage $contactPage)
    {
        $contactPage->submit([]);

        $I->expectTo('see validations errors');

        $I->see('Contact', 'h1');
        $I->see('Name cannot be blank', '.help-block');
        $I->see('Email cannot be blank', '.help-block');
        $I->see('Subject cannot be blank', '.help-block');
        $I->see('Body cannot be blank', '.help-block');
        $I->see('The verification code is incorrect', '.help-block');
    }

    public function checkWrongEmail(AcceptanceTester $I, ContactPage $contactPage)
    {
        $contactPage->submit([
            'name' => 'tester',
            'email' => 'tester.email',
            'subject' => 'test subject',
            'body' => 'test content',
            'verifyCode' => 'testme',
        ]);

        $I->expectTo('see that email address is wrong');

        $I->dontSee('Name cannot be blank', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
        $I->dontSee('Subject cannot be blank', '.help-block');
        $I->dontSee('Body cannot be blank', '.help-block');
        $I->dontSee('The verification code is incorrect', '.help-block');
    }

    public function checkSuccessfulSubmit(AcceptanceTester $I, ContactPage $contactPage)
    {
        $contactPage->submit([
            'name' => 'tester',
            'email' => 'tester@example.com',
            'subject' => 'test subject',
            'body' => 'test content',
            'verifyCode' => 'testme',
        ]);

        $I->expectTo('see notification about successful submit');

        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
