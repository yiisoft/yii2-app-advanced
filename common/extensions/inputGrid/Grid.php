<?php

namespace common\extensions\inputGrid;

use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
/**
 * Description of Grid
 *
 * @author MDMunir
 */
class Grid extends \yii\grid\GridView
{

	/**
	 *
	 * @var ActiveRecord
	 */
	public $modelClass;
	/**
	 *
	 * @var ActiveForm
	 */
	public $form;

	public $layout = "{items}";
	public $formatter = ['class' => 'yii\base\Formatter', 'nullDisplay' => ''];

	/**
	 * @var array the HTML attributes for the container tag of the grid view.
	 * The "tag" element specifies the tag name of the container element and defaults to "div".
	 */
	public $options = ['class' => 'input-grid'];
	
	public $afterAddRow;

	public function init()
	{
		if($this->modelClass===null){
			$models = $this->dataProvider->getModels();
			if(($model = reset($models)) instanceof Model){
				$this->modelClass = $model->classname();
			}
		}
		parent::init();
	}

	public function run()
	{
		$id = $this->options['id'];
		$options = Json::encode($this->getClientOptions());
		$view = $this->getView();
		InputGridAsset::register($view);
		$view->registerJs("jQuery('#$id').mdmInputGrid($options);");
		\yii\widgets\BaseListView::run();
	}

	/**
	 * Returns the options for the grid view JS widget.
	 * @return array the options
	 */
	protected function getClientOptions()
	{
		$count = $this->dataProvider->getCount();
		$modelClass = $this->modelClass;
		$templateRow = $this->renderTableRow(new $modelClass, '', '_index_');
		$options = [
			'counter' => $count < 1 ? 1 : $count,
			'templateRow' => $templateRow,
		];
		if($this->afterAddRow !== null){
			$options['afterAddRow']= new JsExpression($this->afterAddRow);
		}
		return $options;
	}

}