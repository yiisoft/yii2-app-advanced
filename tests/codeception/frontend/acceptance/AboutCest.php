<?php

namespace tests\codeception\frontend\acceptance;

use tests\codeception\frontend\AcceptanceTester;
use tests\codeception\frontend\_pages\AboutPage;

class AboutCest
{
    
    function _before(AcceptanceTester $I, AboutPage $aboutPage)
    {
        $I->amOnPage($aboutPage->getUrl());
    }

    public function checkAbout(AcceptanceTester $I)
    {
        $I->expectTo('see page content');

        $I->see('About', 'h1');
    }
}
