<?php

namespace biz\master\models;

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
 * @property SalesDtl[] $salesDtls
 * @property ProductGroup $idGroup
 * @property Category $idCategory
 * @property PurchaseDtl[] $purchaseDtls
 * @property Cogs[] $cogs
 * @property StockAdjusmentDtl $stockAdjusmentDtl
 * @property ProductSupplier $productSupplier
 * @property Supplier[] $idSuppliers
 * @property ProductUom[] $productUoms
 * @property ProductStock[] $productStocks
 * @property TransferDtl[] $transferDtls
 * @property Price[] $prices
 * @property StockOpnameDtl $stockOpnameDtl
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cd_product', 'nm_product', 'id_category', 'id_group'], 'required'],
            [['id_category', 'id_group', 'create_by', 'update_by'], 'integer'],
            [['create_date', 'update_date'], 'string'],
            [['cd_product'], 'string', 'max' => 13],
            [['nm_product'], 'string', 'max' => 64],
            [['cd_product'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
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
    public function getSalesDtls() {
        return $this->hasMany(SalesDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGroup() {
        return $this->hasOne(ProductGroup::className(), ['id_group' => 'id_group']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory() {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseDtls() {
        return $this->hasMany(PurchaseDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCogs() {
        return $this->hasMany(Cogs::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjusmentDtl() {
        return $this->hasOne(StockAdjusmentDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplier() {
        return $this->hasOne(ProductSupplier::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuppliers() {
        return $this->hasMany(Supplier::className(), ['id_supplier' => 'id_supplier'])->viaTable('product_supplier', ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms() {
        return $this->hasMany(ProductUom::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStocks() {
        return $this->hasMany(ProductStock::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferDtls() {
        return $this->hasMany(TransferDtl::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices() {
        return $this->hasMany(Price::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOpnameDtl() {
        return $this->hasOne(StockOpnameDtl::className(), ['id_product' => 'id_product']);
    }

    public static function ListUoms($id) {
        $sql = 'select u.id_uom,u.nm_uom
                from uom u
                join product_uom pu on(pu.id_uom=u.id_uom)
                where pu.id_product=:id_product';
        $result = [];
        foreach (\Yii::$app->db->createCommand($sql, [':id_product' => $id])->queryAll() as $row) {
            $result[$row['id_uom']] = $row['nm_uom'];
        }
        return $result;
    }

    public function behaviors() {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser'
        ];
    }

}
