<?php

namespace backend\modules\inventory\models;

use \Exception;
use backend\modules\master\models\ProductUom;
use backend\modules\master\models\Cogs;
use backend\modules\master\models\Warehouse;
use backend\modules\master\models\Product;
use backend\modules\master\models\Uom;

/**
 * This is the model class for table "product_stock".
 *
 * @property integer $id_warehouse
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty_stock
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property Warehouse $idWarehouse
 */
class ProductStock extends \yii\db\ActiveRecord
{

	const COLLECTION_NAME = 'log_stock';

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
			[['id_warehouse', 'id_product', 'id_uom', 'qty_stock'], 'required'],
			[['id_warehouse', 'id_product', 'id_uom'], 'integer'],
			[['qty_stock'], 'number'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_warehouse' => 'Id Warehouse',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'qty_stock' => 'Qty Stock',
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
	public function getIdWarehouse()
	{
		return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
	}

	public static function UpdateStock($params,$logs=[])
	{
		$result = [];
		$stock = self::find([
					'id_warehouse' => $params['id_warehouse'],
					'id_product' => $params['id_product'],
		]);
		if (!$stock) {
			$stock = new self();
			
			$stock->setAttributes([
				'id_warehouse' => $params['id_warehouse'],
				'id_product' => $params['id_product'],
				'id_uom' => $params['id_uom'],
				'qty_stock' => 0,
			]);
		}
		
		$result['old_stock'] = $stock->qty_stock;
		$result['added_stock'] = $params['qty'] * $params['qty_per_uom'];

		$stock->qty_stock = $stock->qty_stock + $result['added_stock'];
		if (!empty($logs) && $stock->canSetProperty('logParams')) {
			$stock->logParams = $logs;
		}
		if (!$stock->save()) {
			throw new \yii\base\UserException(implode(",\n", $stock->firstErrors));
		}

		return $result;
	}

	public static function closeStock()
	{
		$transaction = \Yii::$app->db->beginTransaction();
		try {
			$sql = 'insert into product_stock
				(id_warehouse,opening_date,id_product,id_uom,qty_stock,status_closing,
				create_by,create_date,update_by,update_date)
				select id_warehouse,NOW(),id_product,id_uom,qty_stock,:new_status,
				:create_by,NOW(),:update_by,NOW()
				from product_stock
				where status_closing=:old_status';

			$user_id = ($user = \Yii::$app->user) ? $user->id : 0;
			\Yii::$app->db->createCommand($sql, [
				':new_status' => self::STATUS_OPEN_2,
				':create_by' => $user_id,
				':update_by' => $user_id,
				':old_status' => self::STATUS_OPEN,
			])->execute();
			self::updateAll(['status_closing' => self::STATUS_CLOSE], ['status_closing' => self::STATUS_OPEN]);
			self::updateAll(['status_closing' => self::STATUS_OPEN], ['status_closing' => self::STATUS_OPEN_2]);

			$transaction->commit();
		} catch (Exception $exc) {
			$transaction->rollback();
		}
	}

	public function behaviors()
	{
		return [
			'backend\components\AutoTimestamp',
			'backend\components\AutoUser',
			[
				'class' => 'backend\components\Logger',
				'collectionName' => self::COLLECTION_NAME,
				'attributes' => ['id_warehouse', 'id_product', 'id_uom', 'qty_stock'],
			]
		];
	}

}
