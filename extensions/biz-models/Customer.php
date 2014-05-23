<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id_customer
 * @property string $cd_cust
 * @property string $nm_cust
 * @property string $contact_name
 * @property string $contact_number
 * @property integer $status
 * @property integer $update_by
 * @property integer $create_by
 * @property string $update_date
 * @property string $create_date
 * @property string $nmStatus
 *
 * @property CustomerDetail $customerDetail
 * @property SalesHdr[] $salesHdrs
 */
class Customer extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd_cust', 'nm_cust'], 'required'],
            [['status'], 'integer'],
            [['cd_cust'], 'string', 'max' => 13],
            [['nm_cust', 'contact_name', 'contact_number'], 'string', 'max' => 64],
            [['cd_cust'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => 'Id Customer',
            'cd_cust' => 'Cd Cust',
            'nm_cust' => 'Nm Cust',
            'contact_name' => 'Contact Name',
            'contact_number' => 'Contact Number',
            'status' => 'Status',
            'update_by' => 'Update By',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerDetail()
    {
        return $this->hasOne(CustomerDetail::className(), ['id_customer' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesHdrs()
    {
        return $this->hasMany(SalesHdr::className(), ['id_customer' => 'id_customer']);
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
                'class'=>'biz\behaviors\StatusBehavior'
            ]
        ];
    }
}