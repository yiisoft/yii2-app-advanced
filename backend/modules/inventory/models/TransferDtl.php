<?php

namespace backend\modules\inventory\models;

/**
 * This is the model class for table "transfer_dtl".
 *
 * @property string $id_transfer_dtl
 * @property integer $id_transfer_hdr
 * @property integer $id_product
 * @property string $transfer_qty_send
 * @property string $transfer_qty_receive
 * @property string $transfer_qty_confirm
 * @property integer $id_uom
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property TransferHdr $idTransferHdr
 */
class TransferDtl extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'transfer_dtl';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_transfer_hdr', 'id_product', 'transfer_qty_send', 'id_uom'], 'required'],
			[['transfer_qty_receive', 'transfer_qty_confirm'],'safe'],
			[['id_transfer_hdr', 'id_product', 'id_uom'], 'integer'],
			[['transfer_qty_send', 'transfer_qty_receive', 'transfer_qty_confirm'], 'number']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_transfer_dtl' => 'Id Transfer Dtl',
			'id_transfer_hdr' => 'Id Transfer Hdr',
			'id_product' => 'Id Product',
			'transfer_qty_send' => 'Transfer Qty Send',
			'transfer_qty_receive' => 'Transfer Qty Receive',
			'transfer_qty_confirm' => 'Transfer Qty Confirm',
			'id_uom' => 'Id Uom',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdUom()
	{
		return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdTransferHdr()
	{
		return $this->hasOne(TransferHdr::className(), ['id_transfer_hdr' => 'id_transfer_hdr']);
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
