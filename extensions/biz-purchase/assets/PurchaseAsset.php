<?php

namespace biz\purchase\assets;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class PurchaseAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/purchase/assets/js';
    public $js = [
        'purchase.purchase.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}