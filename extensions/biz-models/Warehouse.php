<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property integer $id_warehouse
 * @property integer $id_branch
 * @property string $cd_whse
 * @property string $nm_whse
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property ProductStock[] $productStocks
 * @property TransferHdr[] $transferHdrs
 * @property StockOpname[] $stockOpnames
 * @property SalesDtl[] $salesDtls
 * @property PurchaseDtl[] $purchaseDtls
 * @property Branch $idBranch
 * @property StockAdjustment[] $stockAdjustments
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_branch', 'cd_whse', 'nm_whse'], 'required'],
            [['id_branch'], 'integer'],
            [['cd_whse'], 'string', 'max' => 4],
            [['nm_whse'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_warehouse' => 'Id Warehouse',
            'id_branch' => 'Id Branch',
            'cd_whse' => 'Cd Whse',
            'nm_whse' => 'Nm Whse',
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
        return $this->hasMany(ProductStock::className(), ['id_warehouse' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferHdrs()
    {
        return $this->hasMany(TransferHdr::className(), ['id_warehouse_dest' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOpnames()
    {
        return $this->hasMany(StockOpname::className(), ['id_warehouse' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDtls()
    {
        return $this->hasMany(SalesDtl::className(), ['id_warehouse' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseDtls()
    {
        return $this->hasMany(PurchaseDtl::className(), ['id_warehouse' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBranch()
    {
        return $this->hasOne(Branch::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::className(), ['id_warehouse' => 'id_warehouse']);
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