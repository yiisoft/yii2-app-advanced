<?php

namespace biz\master\models;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id_branch
 * @property integer $id_orgn
 * @property string $cd_branch
 * @property string $nm_branch
 * @property string $create_date
 * @property string $update_date
 * @property integer $update_by
 * @property integer $create_by
 *
 * @property Orgn $idOrgn
 */
class Branch extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'branch';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_orgn', 'cd_branch', 'nm_branch'], 'required'],
			[['id_orgn'], 'integer'],
			[['cd_branch'], 'string', 'max' => 4],
			[['nm_branch'], 'string', 'max' => 32],
			[['cd_branch'], 'unique']
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdOrgn()
	{
		return $this->hasOne(Orgn::className(), ['id_orgn' => 'id_orgn']);
	}

	public function behaviors()
	{
		return [
			'app\tools\AutoTimestamp',
			'app\tools\AutoUser',
		];
	}
}
