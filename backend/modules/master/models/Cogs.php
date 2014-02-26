<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "cogs".
 *
 * @property integer $id_cogs
 * @property integer $id_branch
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $cogs
 * @property string $update_date
 * @property integer $create_by
 * @property string $create_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Branch $idBranch
 * @property Product $idProduct
 */
class Cogs extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'cogs';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_branch', 'id_product', 'id_uom', 'cogs'], 'required'],
			[['id_branch', 'id_product', 'id_uom'], 'integer'],
			[['cogs'], 'number']
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdUom()
	{
		return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdBranch()
	{
		return $this->hasOne(Branch::className(), ['id_branch' => 'id_branch']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
	}

	public static function UpdateCogs($params)
	{
		$cogs = self::find([
					'id_branch' => $params['id_branch'],
					'id_product' => $params['id_product'],
		]);

		if (!$cogs) {
			$cogs = new self();
			$cogs->setAttributes([
				'id_branch' => $params['id_branch'],
				'id_product' => $params['id_product'],
				'id_uom' => $params['id_uom'],
					], false);
		}
		$cogs->cogs = 1.0*($cogs->cogs * $params['old_stock'] + $params['purch_price'] * $params['new_stock']) / ($params['old_stock'] + $params['new_stock']);
		if(!$cogs->save()){
			throw new \yii\base\UserException(implode(",\n", $cogs->firstErrors));
		}
		return true;;
	}

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'backend\components\AutoTimestamp',
			],
			'changeUser' => [
				'class' => 'backend\components\AutoUser',
			]
		];
	}

}
