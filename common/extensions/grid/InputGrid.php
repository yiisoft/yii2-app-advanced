<?php

namespace common\extensions\grid;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Description of InputGrid
 *
 * @author MDMunir
 */
class InputGrid extends \yii\base\Widget
{

	/**
	 * @var string the caption of the grid table
	 * @see captionOptions
	 */
	public $caption;

	/**
	 * @var array the HTML attributes for the caption element.
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 * @see caption
	 */
	public $captionOptions = [];

	/**
	 * @var array the HTML attributes for the grid table element.
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $tableOptions = ['class' => 'table table-striped table-bordered'];

	/**
	 * @var array the HTML attributes for the container tag of the grid view.
	 * The "tag" element specifies the tag name of the container element and defaults to "div".
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $options = ['class' => 'grid-view'];

	/**
	 * @var array the HTML attributes for the table header row.
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $headerRowOptions = [];

	/**
	 * @var array the HTML attributes for the table footer row.
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $footerRowOptions = [];

	/**
	 * @var array|Closure the HTML attributes for the table body rows. This can be either an array
	 * specifying the common HTML attributes for all body rows, or an anonymous function that
	 * returns an array of the HTML attributes. The anonymous function will be called once for every
	 * data model returned by [[dataProvider]]. It should have the following signature:
	 *
	 * ```php
	 * function ($model, $key, $index, $grid)
	 * ```
	 *
	 * - `$model`: the current data model being rendered
	 * - `$key`: the key value associated with the current data model
	 * - `$index`: the zero-based index of the data model in the model array returned by [[dataProvider]]
	 * - `$grid`: the GridView object
	 *
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $rowOptions = [];
	public $rowCallback;

	/**
	 * @var boolean whether to show the header section of the grid table.
	 */
	public $showHeader = true;

	/**
	 * @var boolean whether to show the footer section of the grid table.
	 */
	public $showFooter = false;
	public $models = [];
	public $modelClass;
	public $headerContent;
	public $footerContent;
	public $rowContent;

	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		if($this->modelClass === null && count($this->models)){
				$model = reset($this->models);
				$this->modelClass = get_class($model);
		}
		if($this->modelClass === null){
			throw new \yii\base\InvalidConfigException('');
		}
	}

	public function run()
	{
		$id = $this->options['id'];
		$options = Json::encode($this->getClientOptions());
		$view = $this->getView();
		InputGridAsset::register($view);
		$view->registerJs("jQuery('#$id').mdmInputGrid($options);");
		$tag = ArrayHelper::remove($this->options, 'tag', 'div');
		$content = $this->renderItems();
		echo Html::tag($tag, $content, $this->options);
	}

	public function renderTableHeader()
	{
		if ($this->headerContent !== null) {
			if (is_string($this->headerContent)) {
				$content = Html::tag('tr', $this->headerContent, $this->headerRowOptions);
			} else {
				$content = Html::tag('tr', call_user_func($this->headerContent), $this->headerRowOptions);
			}
			return "<thead>\n" . $content . "\n</thead>";
		}
		return false;
	}

	public function renderTableFooter()
	{
		if ($this->footerContent !== null) {
			if (is_string($this->footerContent)) {
				$content = Html::tag('tr', $this->footerContent, $this->footerRowOptions);
			} else {
				$content = Html::tag('tr', call_user_func($this->footerContent), $this->footerRowOptions);
			}
			return "<tfoot>\n" . $content . "\n</tfoot>";
		}
		return false;
	}

	public function renderTableBody()
	{
		$rows = [];
		foreach ($this->models as $index => $model) {
			if ($model instanceof \yii\db\ActiveRecord) {
				$key = $model->primaryKey;
			} else {
				$key = $index;
			}
			$rows[] = $this->renderTableRow($model, $key, $index);
		}

		return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
	}

	public function renderTableRow($model, $key, $index)
	{
		if ($this->rowOptions instanceof Closure) {
			$options = call_user_func($this->rowOptions, $model, $key, $index, $this);
		} else {
			$options = $this->rowOptions;
		}
		$options['data-key'] = is_array($key) ? json_encode($key) : (string) $key;
		$rowContent = call_user_func($this->rowContent, $model, $key, $index);
		return Html::tag('tr', $rowContent, $options);
	}

	public function renderItems()
	{
		$content = array_filter([
			$this->showHeader ? $this->renderTableHeader() : false,
			$this->showFooter ? $this->renderTableFooter() : false,
			$this->renderTableBody(),
		]);
		return Html::tag('table', implode("\n", $content), $this->tableOptions);
	}

	/**
	 * Returns the options for the grid view JS widget.
	 * @return array the options
	 */
	protected function getClientOptions()
	{
		$count = count($this->models);
		$modelClass = $this->modelClass;
		$templateRow = $this->renderTableRow(new $modelClass, '', '_index_');
		$options = [
			'counter' => $count < 1 ? 1 : $count,
			'templateRow' => $templateRow,
		];
		if ($this->rowCallback !== null) {
			$options['rowCallback'] = new JsExpression($this->rowCallback);
		}
		return $options;
	}

}