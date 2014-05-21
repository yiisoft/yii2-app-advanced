<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id_branch
 * @property integer $id_orgn
 * @property string $cd_branch
 * @property string $nm_branch
 * @property string $create_date
 * @property string $update_date
 * @property integer $create_by
 * @property integer $update_by
 *
 * @property GlHeader[] $glHeaders
 * @property Orgn $idOrgn
 * @property Cashdrawer[] $cashdrawers
 * @property SalesHdr[] $salesHdrs
 * @property PurchaseHdr[] $purchaseHdrs
 * @property Warehouse[] $warehouses
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_orgn', 'cd_branch', 'nm_branch'], 'required'],
            [['id_orgn'], 'integer'],
            [['cd_branch'], 'string', 'max' => 4],
            [['nm_branch'], 'string', 'max' => 32],
            [['cd_branch'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_branch' => 'Id Branch',
            'id_orgn' => 'Id Orgn',
            'cd_branch' => 'Cd Branch',
            'nm_branch' => 'Nm Branch',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGlHeaders()
    {
        return $this->hasMany(GlHeader::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrgn()
    {
        return $this->hasOne(Orgn::className(), ['id_orgn' => 'id_orgn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCashdrawers()
    {
        return $this->hasMany(Cashdrawer::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesHdrs()
    {
        return $this->hasMany(SalesHdr::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseHdrs()
    {
        return $this->hasMany(PurchaseHdr::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['id_branch' => 'id_branch']);
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