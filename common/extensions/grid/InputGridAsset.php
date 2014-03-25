<?php
namespace common\extensions\grid;
/**
 * Description of InputGridAsset
 *
 * @author MDMunir
 */
class InputGridAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@common/extensions/grid/assets';
	public $js = [
		'mdm.inputGrid.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}