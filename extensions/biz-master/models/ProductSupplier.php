<?php

namespace biz\master\models;

/**
 * This is the model class for table "product_supplier".
 *
 * @property integer $id_product
 * @property integer $id_supplier
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Supplier $idSupplier
 * @property Product $idProduct
 */
class ProductSupplier extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product_supplier';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_product', 'id_supplier'], 'required'],
			[['id_product', 'id_supplier'], 'integer'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_product' => 'Id Product',
			'id_supplier' => 'Id Supplier',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
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
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
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
