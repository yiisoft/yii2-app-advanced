<?php

namespace biz\inventory\components;

/**
 * Description of TransferAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class TransferAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/inventory/assets';
    public $js = [
        'js/inventory.transfer.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}