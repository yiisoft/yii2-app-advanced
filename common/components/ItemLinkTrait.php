<?php

namespace common\components;

use Yii;

trait ItemLinkTrait
{
    public $controller_name = 'items';

    public function getLink()
    {
        if (IS_FRONTEND) {
            $url = Yii::$app->urlManager;
        } else {
            $url = Yii::$app->urlManagerFrontEnd;
        }

        $p = ['/' . $this->controller_name . '/view', 'id' => $this->id];

        return $url->createAbsoluteUrl($p);
    }
}