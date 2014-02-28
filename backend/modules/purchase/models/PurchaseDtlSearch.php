<?php

namespace backend\modules\purchase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\purchase\models\PurchaseDtl;

/**
 * PurchaseDtlSearch represents the model behind the search form about PurchaseDtl.
 */
class PurchaseDtlSearch extends Model
{
	public $id_purchase_dtl;
	public $id_purchase_hdr;
	public $id_product;
	public $id_supplier;
	public $purch_price;
	public $purch_qty;
	public $id_uom;
	public $update_date;
	public $update_by;
	public $create_by;
	public $create_date;

	public function rules()
	{
		return [
			[['id_purchase_dtl', 'id_purchase_hdr', 'id_product', 'id_supplier', 'id_uom', 'update_by', 'create_by'], 'integer'],
			[['purch_price', 'purch_qty', 'update_date', 'create_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_purchase_dtl' => 'Id Purchase Dtl',
			'id_purchase_hdr' => 'Id Purchase Hdr',
			'id_product' => 'Id Product',
			'id_supplier' => 'Id Supplier',
			'purch_price' => 'Purch Price',
			'purch_qty' => 'Purch Qty',
			'id_uom' => 'Id Uom',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
		];
	}

	public function search($params)
	{
		$query = PurchaseDtl::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_purchase_dtl');
		$this->addCondition($query, 'id_purchase_hdr');
		$this->addCondition($query, 'id_product');
		$this->addCondition($query, 'id_supplier');
		$this->addCondition($query, 'purch_price', true);
		$this->addCondition($query, 'purch_qty', true);
		$this->addCondition($query, 'id_uom');
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
