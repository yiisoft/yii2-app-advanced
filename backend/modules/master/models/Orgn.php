<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "orgn".
 *
 * @property integer $id_orgn
 * @property string $cd_orgn
 * @property string $nm_orgn
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Branch[] $branches
 */
class Orgn extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'orgn';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cd_orgn', 'nm_orgn'], 'required'],
			[['cd_orgn'], 'string', 'max' => 4],
			[['nm_orgn'], 'string', 'max' => 64]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_orgn' => 'Id Orgn',
			'cd_orgn' => 'Cd Orgn',
			'nm_orgn' => 'Nm Orgn',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getBranches()
	{
		return $this->hasMany(Branch::className(), ['id_orgn' => 'id_orgn']);
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
