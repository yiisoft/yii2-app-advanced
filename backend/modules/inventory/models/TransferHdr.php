<?php

namespace backend\modules\inventory\models;

use backend\modules\master\models\Warehouse;
use backend\modules\master\models\Branch;

/**
 * This is the model class for table "transfer_hdr".
 *
 * @property integer $id_transfer_hdr
 * @property integer $id_branch
 * @property string $transfer_num
 * @property integer $id_warehouse_source
 * @property integer $id_warehouse_dest
 * @property string $transfer_date
 * @property integer $id_status
 * @property string $update_date
 * @property integer $update_by
 * @property integer $create_by
 * @property string $create_date
 *
 * @property TransferDtl[] $transferDtls
 * @property Warehouse $idWarehouseSource
 * @property Warehouse $idWarehouseDest
 * @property Branch $idBranch
 */
class TransferHdr extends \yii\db\ActiveRecord
{
	const STATUS_DRAFT = 1;
	const STATUS_ISSUE = 2;
	const STATUS_DRAFT_RECEIVE = 3;
	const STATUS_CONFIRM = 4;
	const STATUS_CONFIRM_REJECT = 5;
	const STATUS_CONFIRM_APPROVE = 6;
	const STATUS_RECEIVE = 7;


		/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'transfer_hdr';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_branch', 'id_warehouse_source', 'id_warehouse_dest', 'transfer_date', 'id_status'], 'required'],
			[['id_branch', 'id_warehouse_source', 'id_warehouse_dest', 'id_status'], 'integer'],
			[['transfer_date'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_transfer_hdr' => 'Id Transfer Hdr',
			'id_branch' => 'Id Branch',
			'transfer_num' => 'Transfer Num',
			'id_warehouse_source' => 'Id Warehouse Source',
			'id_warehouse_dest' => 'Id Warehouse Dest',
			'transfer_date' => 'Transfer Date',
			'id_status' => 'Id Status',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTransferDtls()
	{
		return $this->hasMany(TransferDtl::className(), ['id_transfer_hdr' => 'id_transfer_hdr']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdWarehouseSource()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse_source']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdWarehouseDest()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse_dest']);
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
			],
			'autoNumber' => [
				'class' => 'backend\components\AutoNumber',
				'digit' => 4,
				'attributes' => [
					self::EVENT_BEFORE_INSERT => ['transfer_num']
				],
				'value' => function($event) {
					return date('2.ymd.?');
				}
			]
		];
	}

}
