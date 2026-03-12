<?php

declare(strict_types=1);

namespace frontend\tests\Acceptance;

use frontend\tests\Support\AcceptanceTester;

final class HomeCest
{
    public function checkHome(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('My Application');

        $I->seeLink('About');
        $I->click('About');

        $I->see('This is the About page.');
    }
}
