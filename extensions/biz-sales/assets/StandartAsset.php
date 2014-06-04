<?php

namespace biz\sales\assets;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class StandartAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/sales/assets/js';
    public $js = [
        'sales.standart.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}