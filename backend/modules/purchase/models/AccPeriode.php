<?php

namespace backend\modules\purchase\models;

/**
 * This is the model class for table "acc_periode".
 *
 * @property integer $id_periode
 * @property integer $id_branch
 * @property string $nm_periode
 * @property string $date_from
 * @property string $date_to
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property ProductStock[] $productStocks
 * @property Branch $idBranch
 */
class AccPeriode extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'acc_periode';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_periode', 'id_branch', 'nm_periode', 'date_from', 'date_to'], 'required'],
			[['id_periode', 'id_branch'], 'integer'],
			[['date_from', 'date_to'], 'safe'],
			[['nm_periode'], 'string', 'max' => 32]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_periode' => 'Id Periode',
			'id_branch' => 'Id Branch',
			'nm_periode' => 'Nm Periode',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProductStocks()
	{
		return $this->hasMany(ProductStock::className(), ['id_periode' => 'id_periode']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdBranch()
	{
		return $this->hasOne(Branch::className(), ['id_branch' => 'id_branch']);
	}
}
