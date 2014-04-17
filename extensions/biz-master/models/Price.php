<?php

namespace biz\master\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id_product
 * @property integer $id_price_category
 * @property integer $id_uom
 * @property string $price
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property PriceCategory $idPriceCategory
 * @property Uom $idUom
 * @property Product $idProduct
 */
class Price extends \yii\db\ActiveRecord
{

	const COLLECTION_NAME = 'log_price';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'price';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id_product', 'id_price_category', 'id_uom', 'price'], 'required'],
			[['id_product', 'id_price_category', 'id_uom'], 'integer'],
			[['price'], 'double']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_product' => 'Id Product',
			'id_price_category' => 'Id Price Category',
			'id_uom' => 'Id Uom',
			'price' => 'Price',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdPriceCategory()
	{
		return $this->hasOne(PriceCategory::className(), ['id_price_category' => 'id_price_category']);
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

	private static function executeFormula($_formula_, $price)
	{
		if(empty($_formula_)){
			return $price;
		}
		$_formula_ = preg_replace('/price/i', '$price', $_formula_);
		return empty($_formula_) ? $price : eval("return $_formula_;");
	}

	public static function UpdatePrice($params, $logs = [])
	{
		$categories = PriceCategory::find()->all();
		foreach ($categories as $category) {
			$price = self::find([
					'id_product' => $params['id_product'],
					'id_price_category' => $category->id_price_category
			]);

			if (!$price) {
				$price = new self();
				$price->setAttributes([
					'id_product' => $params['id_product'],
					'id_price_category' => $category->id_price_category,
					'id_uom' => $params['id_uom'],
					'price' => 0
				]);
			}

			if (!empty($logs) && $price->canSetProperty('logParams')) {
				$price->logParams = $logs;
			}
			$price->price = self::executeFormula($category->formula, $params['price']);
			if (!$price->save()) {
				throw new \yii\base\UserException(implode(",\n", $price->firstErrors));
			}
		}

		return true;
	}

	public function behaviors()
	{
		return [
			'app\tools\AutoTimestamp',
			'app\tools\AutoUser',
			[
				'class' => 'app\tools\Logger',
				'collectionName' => self::COLLECTION_NAME,
				'attributes' => ['id_product', 'id_price_category', 'id_uom', 'price'],
			]
		];
	}

}
