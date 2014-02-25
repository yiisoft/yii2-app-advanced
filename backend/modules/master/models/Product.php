<?php

namespace backend\modules\master\models;

/**
 * This is the model class for table "product".
 *
 * @property integer $id_product
 * @property string $cd_product
 * @property string $nm_product
 * @property integer $id_category
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Category $idCategory
 * @property ProductUom[] $productUoms
 * @property ProductSupplier $productSupplier
 * @property Supplier[] $idSuppliers
 */
class Product extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cd_product', 'nm_product', 'id_category'], 'required'],
			[['id_category'], 'integer'],
			[['cd_product'], 'string', 'max' => 13],
			[['nm_product'], 'string', 'max' => 64],
			[['cd_product'], 'unique']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_product' => 'Id Product',
			'cd_product' => 'Cd Product',
			'nm_product' => 'Nm Product',
			'id_category' => 'Id Category',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdCategory()
	{
		return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProductUoms()
	{
		return $this->hasMany(ProductUom::className(), ['id_product' => 'id_product']);
	}
		
	public static function ListUoms($id)
	{
		$sql = 'select u.id_uom,u.nm_uom
			from uom u
			join product_uom pu on(pu.id_uom=u.id_uom)
			where pu.id_product=:id_product';
		$result = [];
		foreach(\Yii::$app->db->createCommand($sql,[':id_product'=>$id])->queryAll() as $row){
			$result[$row['id_uom']] = $row['nm_uom'];
		}
		return $result;
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getProductSupplier()
	{
		return $this->hasOne(ProductSupplier::className(), ['id_product' => 'id_product']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getIdSuppliers()
	{
		return $this->hasMany(Supplier::className(), ['id_supplier' => 'id_supplier'])->viaTable('product_supplier', ['id_product' => 'id_product']);
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
