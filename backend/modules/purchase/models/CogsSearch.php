<?php

namespace backend\modules\purchase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\purchase\models\Cogs;

/**
 * CogsSearch represents the model behind the search form about Cogs.
 */
class CogsSearch extends Model
{
	public $id_cogs;
	public $id_branch;
	public $id_product;
	public $id_uom;
	public $cogs;
	public $update_date;
	public $create_by;
	public $create_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_cogs', 'id_branch', 'id_product', 'id_uom', 'create_by', 'update_by'], 'integer'],
			[['cogs', 'update_date', 'create_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_cogs' => 'Id Cogs',
			'id_branch' => 'Id Branch',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'cogs' => 'Cogs',
			'update_date' => 'Update Date',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = Cogs::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_cogs');
		$this->addCondition($query, 'id_branch');
		$this->addCondition($query, 'id_product');
		$this->addCondition($query, 'id_uom');
		$this->addCondition($query, 'cogs', true);
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'create_date', true);
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
