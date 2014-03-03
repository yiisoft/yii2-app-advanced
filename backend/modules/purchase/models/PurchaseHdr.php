<?php

namespace backend\modules\purchase\models;

use backend\modules\master\models\Supplier;
use backend\modules\master\models\Warehouse;

/**
 * This is the model class for table "purchase_hdr".
 *
 * @property integer $id_purchase_hdr
 * @property integer $id_branch
 * @property string $purchase_num
 * @property integer $id_supplier
 * @property integer $id_warehouse
 * @property string $purchase_date
 * @property integer $id_status
 * @property string $update_date
 * @property integer $update_by
 * @property integer $create_by
 * @property string $create_date
 *
 * @property PurchaseDtl[] $purchaseDtls
 * @property Supplier $idSupplier
 * @property Warehouse $idWarehouse
 */
class PurchaseHdr extends \yii\db\ActiveRecord
{

	const STATUS_DRAFT = 1;
	const STATUS_RELEASE = 2;
	const STATUS_RECEIVE = 3;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'purchase_hdr';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_supplier', 'id_warehouse', 'purchase_date', 'id_status'], 'required'],
			[['id_supplier', 'id_warehouse', 'id_status'], 'integer'],
			[['purchase_date'], 'safe'],
			[['purchase_num'], 'string', 'max' => 16]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_purchase_hdr' => 'Id Purchase Hdr',
			'purchase_num' => 'Purchase Num',
			'id_supplier' => 'Id Supplier',
			'id_warehouse' => 'Id Warehouse',
			'purchase_date' => 'Purchase Date',
			'id_status' => 'Id Status',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getPurchaseDtls()
	{
		return $this->hasMany(PurchaseDtl::className(), ['id_purchase_hdr' => 'id_purchase_hdr']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdSupplier()
	{
		return $this->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
	}

	public function getNmStatus()
	{
		$maps = [
			self::STATUS_DRAFT => 'Draft',
			self::STATUS_RELEASE => 'Release',
			self::STATUS_RECEIVE => 'Receive',
		];
		return $maps[$this->id_status];
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
				'class' => 'mdm\autonumber\Behavior',
				'digit' => 4,
				'attributes' => [
					self::EVENT_BEFORE_INSERT => ['purchase_num']
				],
				'value' => function($event) {
					return date('1.ymd.?');
				}
			]
		];
	}

}
