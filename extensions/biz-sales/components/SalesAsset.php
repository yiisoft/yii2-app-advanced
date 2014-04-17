<?php

namespace biz\sales\components;

/**
 * Description of SalesAsset
 *
 * @author MDMunir
 */
class SalesAsset extends \yii\web\AssetBundle
{

	public $basePath = '@biz/sales/assets';
	public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',  
    ];
	public $css = [
	];
	public $js = [
	];

}