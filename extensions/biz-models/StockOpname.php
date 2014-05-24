<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "stock_opname".
 *
 * @property integer $id_opname
 * @property string $opname_num
 * @property integer $id_warehouse
 * @property string $opname_date
 * @property string $description
 * @property integer $status
 * @property string $operator1
 * @property string $operator2
 * @property string $operator3
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Warehouse $idWarehouse
 * @property StockOpnameDtl $stockOpnameDtl
 */
class StockOpname extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_opname';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_warehouse', 'opnameDate', 'status', 'operator1'], 'required'],
            [['id_warehouse', 'status'], 'integer'],
            [['opname_date'], 'safe'],
            [['description', 'operator1', 'operator2', 'operator3'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opname' => 'Id Opname',
            'opname_num' => 'Opname Num',
            'id_warehouse' => 'Id Warehouse',
            'opname_date' => 'Opname Date',
            'description' => 'Description',
            'status' => 'Status',
            'operator1' => 'Operator1',
            'operator2' => 'Operator2',
            'operator3' => 'Operator3',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockOpnameDtl()
    {
        return $this->hasOne(StockOpnameDtl::className(), ['id_opname' => 'id_opname']);
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
                'group' => 'opname',
                'attribute' => 'opname_num',
                'value' => date('ymd.?')
            ],
            [
                'class'=>'biz\behaviors\DateConverter',
                'attributes'=>[
                    'opnameDate' => 'opname_date',
                ]
            ],
        ];
    }
}