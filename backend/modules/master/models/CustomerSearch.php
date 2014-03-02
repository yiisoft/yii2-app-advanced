<?php

namespace backend\modules\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about Customer.
 */
class CustomerSearch extends Model
{
	public $id_customer;
	public $cd_cust;
	public $nm_cust;
	public $id_cclass;
	public $contact_name;
	public $contact_number;
	public $status;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_customer', 'id_cclass', 'create_by', 'update_by'], 'integer'],
			[['cd_cust', 'nm_cust', 'contact_name', 'contact_number', 'status', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_customer' => 'Id Customer',
			'cd_cust' => 'Cd Cust',
			'nm_cust' => 'Nm Cust',
			'id_cclass' => 'Id Cclass',
			'contact_name' => 'Contact Name',
			'contact_number' => 'Contact Number',
			'status' => 'Status',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = Customer::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_customer');
		$this->addCondition($query, 'cd_cust', true);
		$this->addCondition($query, 'nm_cust', true);
		$this->addCondition($query, 'id_cclass');
		$this->addCondition($query, 'contact_name', true);
		$this->addCondition($query, 'contact_number', true);
		$this->addCondition($query, 'status', true);
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
