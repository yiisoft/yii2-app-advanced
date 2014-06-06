<?php

namespace biz\sales\components;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class StandartAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/sales/assets';
    public $js = [
        'js/sales.standart.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}