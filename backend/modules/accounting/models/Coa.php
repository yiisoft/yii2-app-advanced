<?php

namespace backend\modules\accounting\models;

/**
 * This is the model class for table "coa".
 *
 * @property integer $id_coa
 * @property integer $id_coa_parent
 * @property string $cd_account
 * @property integer $coa_type
 * @property string $normal_position
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property GlDetail[] $glDetails
 * @property Coa $idCoaParent
 * @property Coa[] $coas
 */
class Coa extends \yii\db\ActiveRecord
{
	const POSITION_DEBET = 'D';
	const POSITION_CREDIT = 'C';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'coa';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_coa_parent', 'coa_type', 'create_by', 'update_by'], 'integer'],
			[['cd_account', 'coa_type', 'normal_position', 'create_date', 'create_by', 'update_date', 'update_by'], 'required'],
			[['create_date', 'update_date'], 'string'],
			[['cd_account'], 'string', 'max' => 16],
			[['normal_position'], 'string', 'max' => 1]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_coa' => 'Id Coa',
			'id_coa_parent' => 'Id Coa Parent',
			'cd_account' => 'Cd Account',
			'coa_type' => 'Coa Type',
			'normal_position' => 'Normal Position',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGlDetails()
	{
		return $this->hasMany(GlDetail::className(), ['id_coa' => 'id_coa']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdCoaParent()
	{
		return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa_parent']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCoas()
	{
		return $this->hasMany(Coa::className(), ['id_coa_parent' => 'id_coa']);
	}
}
