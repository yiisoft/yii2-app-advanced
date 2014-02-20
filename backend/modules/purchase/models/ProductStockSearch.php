<?php

namespace backend\modules\purchase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\purchase\models\ProductStock;

/**
 * ProductStockSearch represents the model behind the search form about ProductStock.
 */
class ProductStockSearch extends Model
{
	public $id_stock;
	public $id_product;
	public $id_periode;
	public $id_warehouse;
	public $status_closing;
	public $qty_stock;
	public $id_uom;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_stock', 'id_product', 'id_periode', 'id_warehouse', 'status_closing', 'id_uom', 'create_by', 'update_by'], 'integer'],
			[['qty_stock', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_stock' => 'Id Stock',
			'id_product' => 'Id Product',
			'id_periode' => 'Id Periode',
			'id_warehouse' => 'Id Warehouse',
			'status_closing' => 'Status Closing',
			'qty_stock' => 'Qty Stock',
			'id_uom' => 'Id Uom',
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
		$this->addCondition($query, 'id_product');
		$this->addCondition($query, 'id_periode');
		$this->addCondition($query, 'id_warehouse');
		$this->addCondition($query, 'status_closing');
		$this->addCondition($query, 'qty_stock', true);
		$this->addCondition($query, 'id_uom');
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
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
