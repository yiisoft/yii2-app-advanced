<?php

namespace biz\inventory\components;

/**
 * Description of TransferAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class ReceiveAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/inventory/assets';
    public $js = [
        'js/inventory.receive.js'
    ];
    public $depends = [
        'biz\tools\BizAsset'
    ];

}