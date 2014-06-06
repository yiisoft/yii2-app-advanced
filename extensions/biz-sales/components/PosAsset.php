<?php

namespace biz\sales\components;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class PosAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/sales/assets';
    public $js = [
        'js/sales.pos.js',
        'js/sales.storage.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}