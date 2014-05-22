<?php

namespace biz\models;

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
            [['price'], 'string']
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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'biz\behaviors\AutoTimestamp',
            'biz\behaviors\AutoUser',
            [
                'class'=>'mdm\tools\Logger',
                'collectionName'=>'log_price',
                'attributes'=>['log_by','log_time1','log_time2','id_product','id_price_category', 'id_uom','price','app','id_ref']
            ],
        ];
    }
}