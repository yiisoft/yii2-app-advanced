<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "purchase_hdr".
 *
 * @property integer $id_purchase
 * @property string $purchase_num
 * @property integer $id_supplier
 * @property integer $id_branch
 * @property string $purchase_date
 * @property string $purchase_value
 * @property string $item_discount
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 * 
 * @property string $nmStatus
 * @property string $purchaseDate
 *
 * @property Supplier $idSupplier
 * @property Branch $idBranch
 * @property PurchaseDtl[] $purchaseDtls
 */
class PurchaseHdr extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 1;
    const STATUS_RECEIVE = 2;

    public $id_warehouse;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_hdr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_value', 'item_discount'], 'default'],
            [['id_supplier'], 'default'],
            [['id_supplier', 'id_branch', 'purchaseDate', 'purchase_value', 'status'], 'required'],
            [['id_branch', 'status'], 'integer'],
            [['purchase_date', 'id_warehouse'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_purchase' => 'Id Purchase',
            'purchase_num' => 'Purchase Num',
            'id_supplier' => 'Id Supplier',
            'id_branch' => 'Id Branch',
            'purchase_date' => 'Purchase Date',
            'purchase_value' => 'Purchase Value',
            'item_discount' => 'Item Discount',
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
    public function getIdSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id_supplier' => 'id_supplier']);
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
    public function getPurchaseDtls()
    {
        return $this->hasMany(PurchaseDtl::className(), ['id_purchase' => 'id_purchase']);
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
                'group' => 'purchase',
                'attribute' => 'purchase_num',
                'value' => 'PU' . date('y.?')
            ],
            [
                'class'=>'biz\behaviors\DateConverter',
                'attributes'=>[
                    'purchaseDate' => 'purchase_date',
                ]
            ],
            [
                'class'=>'biz\behaviors\StatusBehavior'
            ]
        ];
    }
}