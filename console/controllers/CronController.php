<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class CronController extends Controller
{

    function actionIndexTest()
    {
        // https://api.telegram.org/bot<token>/getUpdates

        $bot = new \TelegramBot\Api\BotApi('');
        $chatId = 0;
        $messageText = 'messageText';

        //$bot->sendMessage($chatId, $messageText);
        //$bot->setWebhook();



        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(array(array("one", "two", "three", "three"), array("one", "two", "three")), true, true); // true for one-time keyboard
        $bot->sendMessage($chatId, $messageText, null,  false, null, $keyboard);
    }


}