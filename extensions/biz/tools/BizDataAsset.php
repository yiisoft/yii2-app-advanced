<?php

namespace biz\tools;

use yii\web\View;
use yii\helpers\ArrayHelper;

/**
 * Description of BizDataAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class BizDataAsset
{

    /**
     * 
     * @param View $view
     * @param array $data
     */
    public static function register($view, $data = [], $position = View::POS_BEGIN)
    {
        $default = [
            'config' => [
                'delay' => 1000,
                'limit' => 20,
                'checkStock' => false
            ]
        ];
        $js = "\n biz = " . json_encode(ArrayHelper::merge($default, $data)) . ";\n";
        $view->registerJs($js, $position);
    }
}