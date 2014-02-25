<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "product_stock".
 *
 * @property integer $id_stock
 * @property integer $id_periode
 * @property integer $id_warehouse
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty_stock
 * @property integer $status_closing
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property AccPeriode $idPeriode
 * @property Uom $idUom
 * @property Product $idProduct
 * @property Warehouse $idWarehouse
 */
class ProductStock extends \yii\db\ActiveRecord
{

	const STATUS_OPEN = 1;
	const STATUS_CLOSE = 0;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product_stock';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_periode', 'id_warehouse', 'id_product', 'id_uom', 'qty_stock', 'status_closing'], 'required'],
			[['id_periode', 'id_warehouse', 'id_product', 'id_uom', 'status_closing'], 'integer'],
			[['qty_stock'], 'number']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_stock' => 'Id Stock',
			'id_periode' => 'Id Periode',
			'id_warehouse' => 'Id Warehouse',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'qty_stock' => 'Qty Stock',
			'status_closing' => 'Status Closing',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdPeriode()
	{
		return $this->hasOne(AccPeriode::className(), ['id_periode' => 'id_periode']);
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
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
	}

	public static function UpdateStock($params)
	{
		$stock = self::find([
					'id_periode' => $params['id_periode'],
					'id_warehouse' => $params['id_warehouse'],
					'id_product' => $params['id_product'],
		]);
		if (!$stock) {
			$stock = new self();
			$id_uom = ProductUom::getSmallestUom($params['id_product']);
			$stock->setAttributes([
				'id_periode' => $params['id_periode'],
				'id_warehouse' => $params['id_warehouse'],
				'id_product' => $params['id_product'],
				'id_uom' => $id_uom,
				'status_closing' => self::STATUS_OPEN,
					], true);
		}
		$qty_per_uom = ProductUom::getQtyProductUom($params['id_product'], $params['id_uom']);

		$paramsCogs = [
			'id_periode' => $params['id_periode'],
			'id_branch' => $params['id_branch'],
			'id_product' => $params['id_product'],
			'id_uom' => $stock->id_uom,
			'old_stock' => $stock->qty_stock,
			'new_stock' => $params['purch_qty'] * $qty_per_uom,
			'purch_price' => 1.0 * $params['purch_price'] / $qty_per_uom,
		];

		if (Cogs::UpdateCogs($paramsCogs)) {
			return $stock->save();
		}
		return false;
	}

	public static function closeStock($old_periode, $new_periode)
	{
		$transaction = \Yii::$app->db->beginTransaction();
		try {
			self::updateAll(['status_closing' => self::STATUS_CLOSE], ['id_periode' => $old_periode]);
			$sql = 'insert into product_stock
				(id_periode,id_warehouse,id_product,id_uom,qty_stock,status_closing,
				create_by,create_date,update_by,update_date)
				select :id_periode,id_warehouse,id_product,id_uom,qty_stock,:status_closing,
				:create_by,NOW(),:update_by,NOW()
				from product_stock
				where id_periode=:old_id';

			$user_id = ($user = \Yii::$app->user) ? $user->id : 0;
			\Yii::$app->db->createCommand($sql, [
				':id_periode' => $new_periode,
				':status_closing' => self::STATUS_OPEN,
				':create_by' => $user_id,
				':update_by' => $user_id,
				':old_id' => $old_periode,
			])->execute();
			
			$transaction->commit();
		} catch (Exception $exc) {
			$transaction->rollback();
		}
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
