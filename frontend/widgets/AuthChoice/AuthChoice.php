<?php

namespace frontend\widgets\AuthChoice;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\authclient\widgets\AuthChoice as ParentAuthChoice;

class AuthChoice extends ParentAuthChoice
{
    public function init()
    {
        $view = Yii::$app->getView();
        if ($this->popupMode) {
            AuthChoiceAsset::register($view);
            if (empty($this->clientOptions)) {
                $options = '';
            } else {
                $options = Json::htmlEncode($this->clientOptions);
            }
            $view->registerJs("jQuery('#" . $this->getId() . "').authchoice({$options});");
        } else {
            AuthChoiceStyleAsset::register($view);
        }
        $this->options['id'] = $this->getId();
        echo Html::beginTag('div', $this->options);
    }
}
