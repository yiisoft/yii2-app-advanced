<?php
namespace common\extensions\inputGrid;
/**
 * Description of SerialColumn
 *
 * @author MDMunir
 */
class SerialColumn extends \yii\grid\Column
{
	public $header = '#';

	public $headerOptions = ['class'=>'serial'];
	/**
	 * @inheritdoc
	 */
	protected function renderDataCellContent($model, $key, $index)
	{
		return $index + 1;
	}
}