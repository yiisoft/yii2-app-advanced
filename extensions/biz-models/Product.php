<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id_product
 * @property string $cd_product
 * @property string $nm_product
 * @property integer $id_category
 * @property integer $id_group
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property ProductStock[] $productStocks
 * @property ProductGroup $idGroup
 * @property Category $idCategory
 * @property Price $price
 * @property PriceCategory[] $idPriceCategories
 * @property ProductUom[] $productUoms
 * @property NoticeDtl $noticeDtl
 * @property TransferHdr[] $idTransfers
 * @property Cogs $cogs
 * @property SalesDtl[] $salesDtls
 * @property StockAdjusmentDtl $stockAdjusmentDtl
 * @property PurchaseDtl[] $purchaseDtls
 * @property ProductChild[] $productChildren
 * @property ProductSupplier $productSupplier
 * @property Supplier[] $idSuppliers
 * @property StockOpnameDtl $stockOpnameDtl
 * @property TransferDtl $transferDtl
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
            [['cd_product', 'nm_product', 'id_category', 'id_group'], 'required'],
            [['id_category', 'id_group'], 'integer'],
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
            'id_group' => 'Id Group',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStocks()
    {
        return $this->hasMany(ProductStock::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup()
    {
        return $this->hasOne(ProductGroup::className(), ['id_group' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(Price::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPriceCategories()
    {
        return $this->hasMany(PriceCategory::className(), ['id_price_category' => 'id_price_category'])->viaTable('price', ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms()
    {
        return $this->hasMany(ProductUom::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticeDtl()
    {
        return $this->hasOne(NoticeDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransfers()
    {
        return $this->hasMany(TransferHdr::className(), ['id_transfer' => 'id_transfer'])->viaTable('transfer_dtl', ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCogs()
    {
        return $this->hasOne(Cogs::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDtls()
    {
        return $this->hasMany(SalesDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjusmentDtl()
    {
        return $this->hasOne(StockAdjusmentDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseDtls()
    {
        return $this->hasMany(PurchaseDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductChildren()
    {
        return $this->hasMany(ProductChild::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplier()
    {
        return $this->hasOne(ProductSupplier::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuppliers()
    {
        return $this->hasMany(Supplier::className(), ['id_supplier' => 'id_supplier'])->viaTable('product_supplier', ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOpnameDtl()
    {
        return $this->hasOne(StockOpnameDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferDtl()
    {
        return $this->hasOne(TransferDtl::className(), ['id_product' => 'id_product']);
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