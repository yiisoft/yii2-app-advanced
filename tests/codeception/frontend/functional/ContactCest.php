<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\frontend\_pages\ContactPage;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{

    public function _before(FunctionalTester $I, ContactPage $contactPage)
    {
        $I->amOnPage($contactPage->getUrl());
    }

    public function checkContact(FunctionalTester $I, ContactPage $contactPage)
    {
        $I->wantTo('ensure that contact works');
        $I->see('Contact', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I, ContactPage $contactPage)
    {
        $I->wantTo('ensure that contact empty submit works');
        $contactPage->submit([]);
        $I->expectTo('see validations errors');
        $I->see('Contact', 'h1');
        $I->see('Name cannot be blank', '.help-block');
        $I->see('Email cannot be blank', '.help-block');
        $I->see('Subject cannot be blank', '.help-block');
        $I->see('Body cannot be blank', '.help-block');
        $I->see('The verification code is incorrect', '.help-block');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I, ContactPage $contactPage)
    {
        $I->wantTo('ensure that contact not correck email submit works');
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

    public function checkContactSubmitCorrectData(FunctionalTester $I, ContactPage $contactPage)
    {
        $I->wantTo('ensure that contact not correck email submit works');
        
        $contactPage->submit([
            'name' => 'tester',
            'email' => 'tester@example.com',
            'subject' => 'test subject',
            'body' => 'test content',
            'verifyCode' => 'testme',
        ]);
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
