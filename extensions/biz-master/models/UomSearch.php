<?php

namespace biz\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\Uom;

/**
 * UomSearch represents the model behind the search form about Uom.
 */
class UomSearch extends Model
{
	public $id_uom;
	public $cd_uom;
	public $nm_uom;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_uom', 'create_by', 'update_by'], 'integer'],
			[['cd_uom', 'nm_uom', 'create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_uom' => 'Id Uom',
			'cd_uom' => 'Cd Uom',
			'nm_uom' => 'Nm Uom',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = Uom::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_uom');
		$this->addCondition($query, 'cd_uom', true);
		$this->addCondition($query, 'nm_uom', true);
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
