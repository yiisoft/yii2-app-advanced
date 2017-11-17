<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactFailCest
{
    public function _before(FunctionalTester $I)
    {
        \Yii::$app->set('mailer', 'frontend\tests\stub\MockMailer');
        $I->configureMailer();
        $I->amOnPage(['site/contact']);
    }

    public function checkContactSubmitCorrectDataSendFail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->dontSeeEmailIsSent();
        $I->see('There was an error sending your message.');
    }
}
