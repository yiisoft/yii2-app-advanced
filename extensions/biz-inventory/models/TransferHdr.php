<?php

namespace biz\inventory\models;

use Yii;
use biz\master\models\Warehouse;

/**
 * This is the model class for table "transfer_hdr".
 *
 * @property integer $id_transfer
 * @property string $transfer_num
 * @property integer $id_warehouse_source
 * @property integer $id_warehouse_dest
 * @property string $transfer_date
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property TransferDtl[] $transferDtls
 * @property Warehouse $idWarehouseSource
 * @property Warehouse $idWarehouseDest
 */
class TransferHdr extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 1;
    const STATUS_ISSUE = 2;
    const STATUS_DRAFT_RECEIVE = 3;
    const STATUS_CONFIRM = 4;
    const STATUS_CONFIRM_REJECT = 5;
    const STATUS_CONFIRM_APPROVE = 6;
    const STATUS_RECEIVE = 7;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_hdr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_warehouse_source', 'id_warehouse_dest', 'transfer_date', 'status'], 'required'],
            [['id_warehouse_source', 'id_warehouse_dest', 'status'], 'integer'],
            [['transfer_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfer' => 'Id Transfer',
            'transfer_num' => 'Transfer Num',
            'id_warehouse_source' => 'Id Warehouse Source',
            'id_warehouse_dest' => 'Id Warehouse Dest',
            'transfer_date' => 'Transfer Date',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferDtls()
    {
        return $this->hasMany(TransferDtl::className(), ['id_transfer' => 'id_transfer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWarehouseSource()
    {
        return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse_source']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWarehouseDest()
    {
        return $this->hasOne(Warehouse::className(), ['id_warehouse' => 'id_warehouse_dest']);
    }

    public function getNmStatus()
    {
        $maps = [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ISSUE => 'Release',
            self::STATUS_DRAFT_RECEIVE => 'Draft Receive',
            self::STATUS_CONFIRM => 'Confirm',
            self::STATUS_CONFIRM_APPROVE => 'Approve',
            self::STATUS_CONFIRM_REJECT => 'Reject',
            self::STATUS_RECEIVE => 'Receive',
        ];
        return $maps[$this->status];
    }

    public function behaviors()
    {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser',
            [
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 4,
                'group' => 'transfer',
                'attribute' => 'transfer_num',
                'value' => function($event) {
                return date('ymd.?');
            }
            ]
        ];
    }
}