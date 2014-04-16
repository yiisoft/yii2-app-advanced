<?php

namespace biz\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\Branch;

/**
 * BranchSearch represents the model behind the search form about Branch.
 */
class BranchSearch extends Model
{
	public $id_branch;
	public $id_orgn;
	public $cd_branch;
	public $nm_branch;
	public $create_date;
	public $update_date;
	public $update_by;
	public $create_by;

	public function rules()
	{
		return [
			[['id_branch', 'id_orgn', 'update_by', 'create_by'], 'integer'],
			[['cd_branch', 'nm_branch', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_branch' => 'Id Branch',
			'id_orgn' => 'Id Orgn',
			'cd_branch' => 'Cd Branch',
			'nm_branch' => 'Nm Branch',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
		];
	}

	public function search($params)
	{
		$query = Branch::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_branch');
		$this->addCondition($query, 'id_orgn');
		$this->addCondition($query, 'cd_branch', true);
		$this->addCondition($query, 'nm_branch', true);
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		$this->addCondition($query, 'create_by');
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
