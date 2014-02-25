<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "warehouse".
 *
 * @property integer $id_warehouse
 * @property integer $id_branch Description
 * @property string $cd_whse
 * @property string $nm_whse
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 */
class Warehouse extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'warehouse';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_branch', 'cd_whse', 'nm_whse'], 'required'],
			[['cd_whse'], 'string', 'max' => 4],
			[['nm_whse'], 'string', 'max' => 32]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_warehouse' => 'Id Warehouse',
			'cd_whse' => 'Cd Whse',
			'nm_whse' => 'Nm Whse',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
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
