<?php

declare(strict_types=1);

namespace frontend\tests\Support\Helper;

use Codeception\Module;

final class Functional extends Module
{
    public function seeValidationError(string $message): void
    {
        $this->getModule('Yii2')->see($message, '.invalid-feedback');
    }

    public function dontSeeValidationError(string $message): void
    {
        $this->getModule('Yii2')->dontSee($message, '.invalid-feedback');
    }
}
