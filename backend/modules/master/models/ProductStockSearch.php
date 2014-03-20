<?php

namespace backend\modules\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\ProductStock;

/**
 * ProductStockSearch represents the model behind the search form about `backend\modules\master\models\ProductStock`.
 */
class ProductStockSearch extends Model
{
	public $id_stock;
	public $id_warehouse;
	public $opening_date;
	public $id_product;
	public $id_uom;
	public $qty_stock;
	public $status_closing;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_stock', 'id_warehouse', 'id_product', 'id_uom', 'status_closing', 'create_by', 'update_by'], 'integer'],
			[['opening_date', 'qty_stock', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_stock' => 'Id Stock',
			'id_warehouse' => 'Id Warehouse',
			'opening_date' => 'Opening Date',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'qty_stock' => 'Qty Stock',
			'status_closing' => 'Status Closing',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = ProductStock::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_stock');
		$this->addCondition($query, 'id_warehouse');
		$this->addCondition($query, 'opening_date', true);
		$this->addCondition($query, 'id_product');
		$this->addCondition($query, 'id_uom');
		$this->addCondition($query, 'qty_stock', true);
		$this->addCondition($query, 'status_closing');
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
