<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "stock_adjustment".
 *
 * @property integer $id_adjustment
 * @property string $adjusment_num
 * @property integer $id_warehouse
 * @property string $adjusment_date
 * @property integer $status
 * @property string $id_reff
 * @property string $description
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property StockAdjusmentDtl $stockAdjusmentDtl
 * @property Warehouse $idWarehouse
 */
class StockAdjustment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_adjustment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_warehouse', 'adjusment_date', 'status', 'id_reff'], 'required'],
            [['id_warehouse', 'status'], 'integer'],
            [['adjusment_date'], 'safe'],
            [['id_reff', 'description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_adjustment' => 'Id Adjustment',
            'adjusment_num' => 'Adjusment Num',
            'id_warehouse' => 'Id Warehouse',
            'adjusment_date' => 'Adjusment Date',
            'status' => 'Status',
            'id_reff' => 'Id Reff',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjusmentDtl()
    {
        return $this->hasOne(StockAdjusmentDtl::className(), ['id_adjustment' => 'id_adjustment']);
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
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 4,
                'group' => 'adjusment',
                'attribute' => 'adjusment_num',
                'value' => date('ymd.?')
            ]
        ];
    }
}