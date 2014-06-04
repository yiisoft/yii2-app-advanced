<?php

namespace biz\inventory\assets;

/**
 * Description of TransferAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class TransferAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/inventory/assets/js';
    public $js = [
        'inventory.transfer.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}