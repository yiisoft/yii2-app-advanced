<?php

namespace biz\sales\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\sales\models\SalesHdr;

/**
 * SalesHdrSearch represents the model behind the search form about `biz\sales\models\SalesHdr`.
 */
class SalesHdrSearch extends Model
{
	public $id_sales_hdr;
	public $sales_num;
	public $id_warehouse;
	public $id_customer;
	public $update_by;
	public $update_date;
	public $create_by;
	public $create_date;
	public $sales_date;

	public function rules()
	{
		return [
			[['id_sales_hdr', 'id_warehouse', 'id_customer', 'update_by', 'create_by'], 'integer'],
			[['sales_num', 'update_date', 'create_date', 'sales_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_sales_hdr' => 'Id Sales Hdr',
			'sales_num' => 'Sales Num',
			'id_warehouse' => 'Id Warehouse',
			'id_customer' => 'Id Customer',
			'update_by' => 'Update By',
			'update_date' => 'Update Date',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'sales_date' => 'Sales Date',
		];
	}

	public function search($params)
	{
		$query = SalesHdr::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_sales_hdr');
		$this->addCondition($query, 'sales_num', true);
		$this->addCondition($query, 'id_warehouse');
		$this->addCondition($query, 'id_customer');
		$this->addCondition($query, 'update_by');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'sales_date', true);
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
