<?php

namespace biz\sales\assets;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class PosAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/sales/assets/js';
    public $js = [
        'sales.pos.js',
        'sales.storage.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}