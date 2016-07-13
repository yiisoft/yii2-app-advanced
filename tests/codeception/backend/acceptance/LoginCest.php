<?php

namespace tests\codeception\backend\acceptance;

use common\models\LoginForm;
use tests\codeception\backend\AcceptanceTester;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function loginUser(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('input[name="' . $this->getFormName() . '[username]"]', 'erau');
        $I->fillField('input[name="' . $this->getFormName() . '[password]"]', 'password_0');
        $I->click('login-button');

        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }

    /**
     * Get name of login form
     *
     * @return string
     */
    protected function getFormName()
    {
        $loginForm = new LoginForm;

        return $loginForm->formName();
    }
}
