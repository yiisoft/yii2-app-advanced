<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "product_stock".
 *
 * @property integer $id_stock
 * @property integer $id_warehouse
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $qty_stock
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 * @property Warehouse $idWarehouse
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_warehouse', 'id_product', 'id_uom', 'qty_stock'], 'required'],
            [['id_warehouse', 'id_product', 'id_uom'], 'integer'],
            [['qty_stock'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_stock' => 'Id Stock',
            'id_warehouse' => 'Id Warehouse',
            'id_product' => 'Id Product',
            'id_uom' => 'Id Uom',
            'qty_stock' => 'Qty Stock',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getIdWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
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
                'collectionName'=>'log_stock',
                'attributes'=>['log_by','log_time1','log_time2','id_warehouse','id_product','id_uom','mv_qty','qty_stock','app','id_ref']
            ]
        ];
    }
}