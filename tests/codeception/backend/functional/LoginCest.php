<?php

namespace tests\codeception\backend\functional;

use common\models\LoginForm;
use tests\codeception\backend\FunctionalTester;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * @param FunctionalTester $I
     */
    public function loginUserWithEmptyData(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('input[name="' . $this->getFormName() . '[username]"]', '');
        $I->fillField('input[name="' . $this->getFormName() . '[password]"]', '');
        $I->click('login-button');

        $I->see('Username cannot be blank.', '.help-block');
        $I->see('Password cannot be blank.', '.help-block');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginUserWithWrongData(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('input[name="' . $this->getFormName() . '[username]"]', 'admin');
        $I->fillField('input[name="' . $this->getFormName() . '[password]"]', 'wrong');
        $I->click('login-button');

        $I->see('Incorrect username or password.', '.help-block');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
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
