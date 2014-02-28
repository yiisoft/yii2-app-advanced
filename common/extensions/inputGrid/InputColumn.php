<?php

namespace common\extensions\inputGrid;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Description of InputColumn
 *
 * @author MDMunir
 */
class InputColumn extends \yii\grid\DataColumn
{

	public $template = '{content}';
	public $inputType = 'textInput';
	public $inputOptions = [];
	public $inputItems = [];
	private $_isList = false;

	public function init()
	{
		$this->_isList = strpos(strtolower($this->inputType), 'list');
		parent::init();
	}

	/**
	 * 
	 * @param \yii\base\Model $model
	 * @param type $key
	 * @param type $index
	 * @return type
	 */
	protected function renderDataCellContent($model, $key, $index)
	{
		if ($this->value !== null) {
			if (is_string($this->value)) {
				$value = ArrayHelper::getValue($model, $this->value);
			} else {
				$value = call_user_func($this->value, $model, $index, $this);
			}
		} elseif ($this->content === null && $this->attribute !== null) {
			$value = $this->renderInput($model, $index);
		} else {
			$value = parent::renderDataCellContent($model, $key, $index);
		}
		return strtr($this->template, ['{content}' => $value]);
	}

	/**
	 * 
	 * @param \yii\base\Model $model
	 * @param integer $index
	 * @return type
	 */
	protected function renderInput($model, $index)
	{
		if ($this->inputOptions instanceof \Closure) {
			$options = call_user_func($this->inputOptions, $model, $index);
		} else {
			$options = $this->inputOptions;
		}
		$options['data-attribute'] = $this->attribute;
		if ($this->_isList) {
			if ($this->inputItems instanceof \Closure) {
				$items = call_user_func($this->inputItems, $model, $index);
			} else {
				$items = $this->inputItems;
			}
			if ($model->hasProperty($this->attribute)) {
				return call_user_func(['yii\helpers\Html', 'active' . $this->inputType], $model, "[$index]{$this->attribute}", $items, $options);
			} else {
				$name = Html::getInputName($model, "[$index]{$this->attribute}");
				$value = ArrayHelper::remove($options, 'value');
				return call_user_func(['yii\helpers\Html', $this->inputType], $name, $value, $items, $options);
			}
		} else {
			if ($model->hasProperty($this->attribute)) {
				return call_user_func(['yii\helpers\Html', 'active' . $this->inputType], $model, "[$index]{$this->attribute}", $options);
			} else {
				$name = Html::getInputName($model, "[$index]{$this->attribute}");
				$value = ArrayHelper::remove($options, 'value');
				return call_user_func(['yii\helpers\Html', $this->inputType], $name, $value, $options);
			}
		}
	}

}