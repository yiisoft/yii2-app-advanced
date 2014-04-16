<?php

namespace biz\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form about Supplier.
 */
class SupplierSearch extends Model
{
	public $id_supplier;
	public $cd_supplier;
	public $nm_supplier;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_supplier', 'create_by', 'update_by'], 'integer'],
			[['cd_supplier', 'nm_supplier', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_supplier' => 'Id Supplier',
			'cd_supplier' => 'Cd Supplier',
			'nm_supplier' => 'Nm Supplier',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = Supplier::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_supplier');
		$this->addCondition($query, 'cd_supplier', true);
		$this->addCondition($query, 'nm_supplier', true);
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
