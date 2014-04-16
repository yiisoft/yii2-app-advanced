<?php

namespace biz\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\Warehouse;

/**
 * WarehouseSearch represents the model behind the search form about Warehouse.
 */
class WarehouseSearch extends Model
{
	public $id_warehouse;
	public $cd_whse;
	public $nm_whse;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_warehouse', 'create_by', 'update_by'], 'integer'],
			[['cd_whse', 'nm_whse', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_warehouse' => 'Id Warehouse',
			'cd_whse' => 'Cd Whse',
			'nm_whse' => 'Nm Whse',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = Warehouse::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_warehouse');
		$this->addCondition($query, 'cd_whse', true);
		$this->addCondition($query, 'nm_whse', true);
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
