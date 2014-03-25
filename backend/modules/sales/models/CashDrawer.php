<?php

namespace backend\modules\sales\models;

use backend\modules\master\models\Branch;
/**
 * This is the model class for table "log_cashier".
 *
 * @property string $id_log
 * @property integer $id_branch
 * @property integer $no_cashier
 * @property string $initial_cash
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Branch $idBranch
 */
class CashDrawer extends \yii\db\ActiveRecord
{
	const STATUS_OPEN = 1;
	const STATUS_CLOSE = 2;

	public $name_cashier;
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'cash_drawer';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_branch', 'no_cashier', 'initial_cash','id_status'], 'required'],
			[['id_branch', 'no_cashier'], 'integer'],
			[['initial_cash','close_cash'], 'double']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_cash_drawer' => 'Id Cash Drawer',
			'id_branch' => 'Id Branch',
			'no_cashier' => 'No Cashier',
			'initial_cash' => 'Initial Cash',
			'close_cash' => 'Close Cash',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdBranch()
	{
		return $this->hasOne(Branch::className(), ['id_branch' => 'id_branch']);
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
