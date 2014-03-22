<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "product_uom".
 *
 * @property integer $id_puom
 * @property integer $id_product
 * @property integer $id_uom
 * @property integer $isi
 * @property boolean $smallest
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 */
class ProductUom extends \yii\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product_uom';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_product', 'id_uom', 'isi', 'smallest'], 'required'],
			[['id_product', 'id_uom', 'isi'], 'integer'],
			[['smallest'], 'boolean'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_puom' => 'Id Puom',
			'id_product' => 'Id Product',
			'id_uom' => 'Id Uom',
			'isi' => 'Isi',
			'smallest' => 'Smallest',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdUom()
	{
		return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdProduct()
	{
		return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
	}

	/**
	 * @return integer
	 */
	public static function getSmallestUom($id)
	{
		$sql = 'select pu.id_uom
			from product_uom pu
			where pu.id_product=:id
			order by pu.isi ASC';
		return \Yii::$app->db->createCommand($sql, [':id' => $id])->queryScalar();
	}

	/**
	 * @return integer
	 */
	public static function getQtyProductUom($id_product, $id_uom)
	{
		$sql = 'select pu.isi
			from product_uom pu
			where pu.id_product=:id_product and pu.id_uom=:id_uom';
		return \Yii::$app->db->createCommand($sql, [
			':id_product' => $id_product,
			':id_uom' => $id_uom]
				)->queryScalar();
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