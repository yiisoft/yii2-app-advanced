<?php

namespace biz\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\CustomerDetail;

/**
 * CustomerDetailSearch represents the model behind the search form about CustomerDetail.
 */
class CustomerDetailSearch extends Model
{
	public $id_customer;
	public $id_distric;
	public $addr1;
	public $addr2;
	public $latitude;
	public $longtitude;
	public $id_kab;
	public $id_kec;
	public $id_kel;
	public $file_name;
	public $file_type;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;
	public $file_size;

	public function rules()
	{
		return [
			[['id_customer', 'id_distric', 'id_kab', 'id_kec', 'id_kel', 'create_by', 'update_by', 'file_size'], 'integer'],
			[['addr1', 'addr2', 'latitude', 'longtitude', 'file_name', 'file_type', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_customer' => 'Id Customer',
			'id_distric' => 'Id Distric',
			'addr1' => 'Addr1',
			'addr2' => 'Addr2',
			'latitude' => 'Latitude',
			'longtitude' => 'Longtitude',
			'id_kab' => 'Id Kab',
			'id_kec' => 'Id Kec',
			'id_kel' => 'Id Kel',
			'file_name' => 'File Name',
			'file_type' => 'File Type',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'file_size' => 'File Size',
		];
	}

	public function search($params)
	{
		$query = CustomerDetail::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_customer');
		$this->addCondition($query, 'id_distric');
		$this->addCondition($query, 'addr1', true);
		$this->addCondition($query, 'addr2', true);
		$this->addCondition($query, 'latitude', true);
		$this->addCondition($query, 'longtitude', true);
		$this->addCondition($query, 'id_kab');
		$this->addCondition($query, 'id_kec');
		$this->addCondition($query, 'id_kel');
		$this->addCondition($query, 'file_name', true);
		$this->addCondition($query, 'file_type', true);
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		$this->addCondition($query, 'file_size');
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
