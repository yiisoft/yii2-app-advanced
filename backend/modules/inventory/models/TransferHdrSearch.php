<?php

namespace backend\modules\inventory\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\inventory\models\TransferHdr;

/**
 * TransferHdrSearch represents the model behind the search form about `backend\modules\inventory\models\TransferHdr`.
 */
class TransferHdrSearch extends Model
{
	public $id_transfer_hdr;
	public $id_branch;
	public $transfer_num;
	public $id_warehouse_source;
	public $id_warehouse_dest;
	public $transfer_date;
	public $id_status;
	public $update_date;
	public $update_by;
	public $create_by;
	public $create_date;

	public function rules()
	{
		return [
			[['id_transfer_hdr', 'id_branch', 'id_warehouse_source', 'id_warehouse_dest', 'id_status', 'update_by', 'create_by'], 'integer'],
			[['transfer_num', 'transfer_date', 'update_date', 'create_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_transfer_hdr' => 'Id Transfer Hdr',
			'id_branch' => 'Id Branch',
			'transfer_num' => 'Transfer Num',
			'id_warehouse_source' => 'Id Warehouse Source',
			'id_warehouse_dest' => 'Id Warehouse Dest',
			'transfer_date' => 'Transfer Date',
			'id_status' => 'Id Status',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
		];
	}

	public function search($params)
	{
		$query = TransferHdr::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_transfer_hdr');
		$this->addCondition($query, 'id_branch');
		$this->addCondition($query, 'transfer_num', true);
		$this->addCondition($query, 'id_warehouse_source');
		$this->addCondition($query, 'id_warehouse_dest');
		$this->addCondition($query, 'transfer_date');
		$this->addCondition($query, 'id_status');
		$this->addCondition($query, 'update_date', true);
		$this->addCondition($query, 'update_by');
		$this->addCondition($query, 'create_by');
		$this->addCondition($query, 'create_date', true);
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
