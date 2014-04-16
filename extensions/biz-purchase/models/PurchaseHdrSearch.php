<?php

namespace biz\purchase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\purchase\models\PurchaseHdr;

/**
 * PurchaseHdrSearch represents the model behind the search form about PurchaseHdr.
 */
class PurchaseHdrSearch extends Model
{
	public $id_purchase_hdr;
	public $purchase_num;
	public $id_supplier;
	public $id_warehouse;
	public $purchase_date;
	public $status;
	public $update_date;
	public $update_by;
	public $create_by;
	public $create_date;

	public function rules()
	{
		return [
			[['id_purchase_hdr', 'id_supplier', 'id_warehouse', 'status', 'update_by', 'create_by'], 'integer'],
			[['purchase_num', 'purchase_date', 'update_date', 'create_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_purchase_hdr' => 'Id Purchase Hdr',
			'purchase_num' => 'Purchase Num',
			'id_supplier' => 'Id Supplier',
			'id_warehouse' => 'Id Warehouse',
			'purchase_date' => 'Purchase Date',
			'status' => 'Status',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
		];
	}

	public function search($params)
	{
		$query = PurchaseHdr::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_purchase_hdr');
		$this->addCondition($query, 'purchase_num', true);
		$this->addCondition($query, 'id_supplier');
		$this->addCondition($query, 'id_warehouse');
		$this->addCondition($query, 'purchase_date');
		$this->addCondition($query, 'status');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'create_date', true);
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
