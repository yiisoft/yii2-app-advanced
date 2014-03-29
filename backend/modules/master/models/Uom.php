<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "uom".
 *
 * @property integer $id_uom
 * @property string $cd_uom
 * @property string $nm_uom
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property SalesDtl[] $salesDtls
 * @property PurchaseDtl[] $purchaseDtls
 * @property Cogs[] $cogs
 * @property StockAdjusmentDtl $stockAdjusmentDtl
 * @property ProductUom[] $productUoms
 * @property ProductStock[] $productStocks
 * @property TransferDtl[] $transferDtls
 * @property Price[] $prices
 * @property StockOpnameDtl $stockOpnameDtl
 */
class Uom extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'uom';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cd_uom', 'nm_uom'], 'required'],
            [['create_date', 'update_date'], 'string'],
            [['create_by', 'update_by'], 'integer'],
            [['cd_uom'], 'string', 'max' => 4],
            [['nm_uom'], 'string', 'max' => 32],
            [['cd_uom'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_uom' => 'Id Uom',
            'cd_uom' => 'Cd Uom',
            'nm_uom' => 'Nm Uom',
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
        return $this->hasMany(SalesDtl::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseDtls() {
        return $this->hasMany(PurchaseDtl::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCogs() {
        return $this->hasMany(Cogs::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjusmentDtl() {
        return $this->hasOne(StockAdjusmentDtl::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUoms() {
        return $this->hasMany(ProductUom::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStocks() {
        return $this->hasMany(ProductStock::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferDtls() {
        return $this->hasMany(TransferDtl::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices() {
        return $this->hasMany(Price::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOpnameDtl() {
        return $this->hasOne(StockOpnameDtl::className(), ['id_uom' => 'id_uom']);
    }

    public function behaviors() {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser'
        ];
    }

}
