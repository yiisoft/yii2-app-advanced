<?php

namespace biz\sales\components;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class DrawerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/sales/assets';
    public $js = [
        'js/sales.storage.js',
        'js/sales.drawer.js',
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}