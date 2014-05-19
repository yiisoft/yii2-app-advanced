<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "price_category".
 *
 * @property integer $id_price_category
 * @property string $nm_price_category
 * @property string $formula
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 * @property string $create_date
 *
 * @property Price[] $prices
 * @property Product[] $idProducts
 */
class PriceCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['squence_price'],'linkFilter'],
            [['nm_price_category'], 'required'],
            [['nm_price_category', 'formula'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_price_category' => 'Id Price Category',
            'nm_price_category' => 'Nm Price Category',
            'formula' => 'Formula',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['id_price_category' => 'id_price_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducts()
    {
        return $this->hasMany(Product::className(), ['id_product' => 'id_product'])->viaTable('price', ['id_price_category' => 'id_price_category']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'biz\behaviors\AutoTimestamp',
            'biz\behaviors\AutoUser',
        ];
    }
}