<?php

namespace frontend\fixtures;


class MockMailer extends \Codeception\Lib\Connector\Yii2\TestMailer
{
    protected function sendMessage($message)
    {
        return false;
    }
}