<?php

namespace biz\master\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id_customer
 * @property string $cd_cust
 * @property string $nm_cust
 * @property string $contact_name
 * @property string $contact_number
 * @property string $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property CustomerDetail $customerDetail
 * @property SalesHdr[] $salesHdrs
 */
class Customer extends \yii\db\ActiveRecord {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cd_cust', 'nm_cust'], 'required'],
            [['status', 'create_date', 'update_date'], 'string'],
            [['create_by', 'update_by'], 'integer'],
            [['cd_cust'], 'string', 'max' => 13],
            [['nm_cust', 'contact_name', 'contact_number'], 'string', 'max' => 64],
            [['cd_cust'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_customer' => 'Id Customer',
            'cd_cust' => 'Cd Cust',
            'nm_cust' => 'Nm Cust',
            'contact_name' => 'Contact Name',
            'contact_number' => 'Contact Number',
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
    public function getCustomerDetail() {
        return $this->hasOne(CustomerDetail::className(), ['id_customer' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesHdrs() {
        return $this->hasMany(SalesHdr::className(), ['id_customer' => 'id_customer']);
    }

    public function getStatus() {
        $maps = [
            self::STATUS_INACTIVE => 'InActive',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_BLOCKED => 'Blocked'            
        ];
        return $maps;
    }

    public function behaviors() {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser'
        ];
    }

}
