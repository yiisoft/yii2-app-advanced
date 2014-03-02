<?php
namespace common\extensions\inputGrid;

use yii\db\ActiveRecord;
use yii\helpers\Html;
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
	 * 
	 * @param ActiveRecord $model
	 * @param type $key
	 * @param type $index
	 * @return type
	 */
	protected function renderDataCellContent($model, $key, $index)
	{
		$result = Html::tag('span', $index+1, ['class'=>'serial-column']);
		if($model instanceof ActiveRecord && ($primaryKeys=$model->primaryKey())!=[]){
			foreach ($primaryKeys as $primary) {
				$result.= ' '.Html::activeHiddenInput($model, "[$index]$primary");
			}
		}
		return $result;
	}
}