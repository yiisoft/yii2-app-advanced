<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 10.09.2016
     * Time: 23:22
     */

    namespace common\components;


    trait ItemLinkTrait
    {
        public $controller_name = 'items';

        function getLink()
        {
            if(IS_FRONT)
            {
                $url = Yii::$app->urlManager;
            }
            else
            {
                $url = Yii::$app->urlManagerFrontEnd;
            }

            $p = ['/' . $this->controller_name .'/view', 'id'=> $this->id];

            return $url->createAbsoluteUrl($p);
        }
    }