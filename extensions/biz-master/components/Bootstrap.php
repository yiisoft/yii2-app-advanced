<?php

namespace biz\master\components;

/**
 * Description of Bootstrapt
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class Bootstrap implements \yii\base\BootstrapInterface
{

    /**
     * 
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $app->attachBehaviors([
            CogsHook::className(),
            PriceHook::className(),
            StockHook::className()
        ]);
    }
}