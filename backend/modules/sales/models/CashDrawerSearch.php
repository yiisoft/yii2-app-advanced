<?php

namespace backend\modules\sales\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sales\models\CashDrawer;

/**
 * CashDrawerSearch represents the model behind the search form about `backend\modules\sales\models\CashDrawer`.
 */
class CashDrawerSearch extends Model
{
	public $id_cash_drawer;
	public $id_branch;
	public $no_cashier;
	public $initial_cash;
	public $close_cash;
	public $create_date;
	public $id_status;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_cash_drawer', 'initial_cash', 'close_cash', 'create_date', 'update_date'], 'safe'],
			[['id_branch', 'no_cashier', 'id_status', 'create_by', 'update_by'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_cash_drawer' => 'Id Cash Drawer',
			'id_branch' => 'Id Branch',
			'no_cashier' => 'No Cashier',
			'initial_cash' => 'Initial Cash',
			'close_cash' => 'Close Cash',
			'create_date' => 'Create Date',
			'id_status' => 'Id Status',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = CashDrawer::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_cash_drawer', true);
		$this->addCondition($query, 'id_branch');
		$this->addCondition($query, 'no_cashier');
		$this->addCondition($query, 'initial_cash', true);
		$this->addCondition($query, 'close_cash', true);
		$this->addCondition($query, 'create_date', true);
		$this->addCondition($query, 'id_status');
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
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
