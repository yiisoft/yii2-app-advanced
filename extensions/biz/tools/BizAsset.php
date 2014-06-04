<?php

namespace biz\tools;

/**
 * Description of BizAsset
 *
 * @author Misbahul D Munir (mdmunir) <misbahuldmunir@gmail.com>
 */
class BizAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@biz/assets';
    public $js = [
        'js/mdm.numeric.js',
        'js/numeral.min.js',
        'js/jquery.number.js',
        'js/mdm.global.js'
    ];
    public $css = [
        'css/biz.detail.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}