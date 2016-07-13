<?php

namespace tests\codeception\frontend\functional;

use tests\codeception\frontend\FunctionalTester;
use tests\codeception\frontend\_pages\AboutPage;

class AboutCest
{

    public function checkAbout(FunctionalTester $I)
    {
        $I->wantTo('ensure that about works');
        AboutPage::openBy($I);
        $I->see('About', 'h1');
    }
}
