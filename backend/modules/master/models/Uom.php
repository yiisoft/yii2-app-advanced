<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "uom".
 *
 * @property integer $id_uom
 * @property string $cd_uom
 * @property string $nm_uom
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property ProductUom[] $productUoms
 */
class Uom extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'uom';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cd_uom', 'nm_uom'], 'required'],
			[['cd_uom'], 'string', 'max' => 4],
			[['nm_uom'], 'string', 'max' => 32],
			[['cd_uom'], 'unique']
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProductUoms()
	{
		return $this->hasMany(ProductUom::className(), ['id_uom' => 'id_uom']);
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
