<?php

namespace biz\purchase\components;

/**
 * Description of Asset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class PurchaseAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/purchase/assets';
    public $js = [
        'js/purchase.purchase.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}