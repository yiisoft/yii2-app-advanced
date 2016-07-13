<?php

namespace tests\codeception\frontend\acceptance;

use tests\codeception\frontend\AcceptanceTester;
use tests\codeception\common\_pages\LoginPage;

class LoginCest
{
    
    function _before(AcceptanceTester $I, LoginPage $loginPage)
    {
        $I->amOnPage($loginPage->getUrl());
    }

    public function checkEmpty(AcceptanceTester $I, LoginPage $loginPage)
    {
        $loginPage->login('', '');

        $I->expectTo('see validations errors');

        $I->see('Username cannot be blank.', '.help-block');
        $I->see('Password cannot be blank.', '.help-block');
    }

    public function checkWrongCredentials(AcceptanceTester $I, LoginPage $loginPage)
    {
        $loginPage->login('admin', 'wrong');

        $I->expectTo('see validations errors');

        $I->see('Incorrect username or password.', '.help-block');
    }

    public function checkCorrectLogin(AcceptanceTester $I, LoginPage $loginPage)
    {
        $loginPage->login('erau', 'password_0');

        $I->expectTo('see that user is logged');

        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
