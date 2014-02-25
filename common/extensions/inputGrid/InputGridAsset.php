<?php
namespace common\extensions\inputGrid;
/**
 * Description of InputGridAsset
 *
 * @author MDMunir
 */
class InputGridAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@common/extensions/inputGrid/assets';
	public $js = [
		'mdm.inputGrid.js',
	];
	public $depends = [
		'yii\grid\GridViewAsset',
	];
}