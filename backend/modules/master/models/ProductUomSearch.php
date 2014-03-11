<?php

namespace backend\modules\master\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\master\models\ProductUom;

/**
 * ProductUomSearch represents the model behind the search form about ProductUom.
 */
class ProductUomSearch extends Model
{
	public $id_puom;
	public $id_product;
	public $id_uom;
	public $isi;
	public $smallest;
	public $create_date;
	public $create_by;
	public $update_date;
	public $update_by;

	public function rules()
	{
		return [
			[['id_puom', 'id_product', 'id_uom', 'isi', 'create_by', 'update_by'], 'integer'],
			[['smallest'], 'boolean'],
			[['create_date', 'update_date'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_puom' => 'Id Puom',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'isi' => 'Isi',
			'smallest' => 'Smallest',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	public function search($params)
	{
		$query = ProductUom::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id_puom');
		$this->addCondition($query, 'id_product');
		$this->addCondition($query, 'id_uom');
		$this->addCondition($query, 'isi');
		$this->addCondition($query, 'smallest');
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