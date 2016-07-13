<?php

namespace tests\codeception\frontend\acceptance;

use Yii;
use tests\codeception\frontend\AcceptanceTester;

class HomeCest
{

    public function checkHome(AcceptanceTester $I)
    {
        $I->wantTo('ensure that home page works');
        $I->amOnPage(Yii::$app->homeUrl);
        $I->see('My Company');
        $I->seeLink('About');
        $I->click('About');
        $I->see('This is the About page.');
    }
}