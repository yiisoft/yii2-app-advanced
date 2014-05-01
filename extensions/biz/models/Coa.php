<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "coa".
 *
 * @property integer $id_coa
 * @property integer $id_coa_parent
 * @property string $cd_account
 * @property string $nm_account
 * @property integer $coa_type
 * @property string $normal_balance
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 * @property string $nmCoaType
 *
 * @property GlDetail[] $glDetails
 * @property EntriSheetDtl[] $entriSheetDtls
 * @property Coa $idCoaParent
 * @property Coa[] $coas
 */
class Coa extends \yii\db\ActiveRecord
{

    private static $_acc_type = [
        100000 => 'AKTIVA',
        200000 => 'KEWAJIBAN',
        300000 => 'MODAL',
        400000 => 'PENDAPATAN',
        500000 => 'HPP',
        600000 => 'BIAYA'
    ];
    private static $_balance_type = [
        'D' => 'DEBIT', 
        'K' => 'KREDIT',
    ];    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_coa_parent', 'coa_type'], 'integer'],
            [['cd_account', 'nm_account', 'coa_type', 'normal_balance'], 'required'],
            [['cd_account'], 'string', 'max' => 16],
            [['nm_account'], 'string', 'max' => 64],
            [['normal_balance'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_coa' => 'Id Coa',
            'id_coa_parent' => 'Id Coa Parent',
            'cd_account' => 'Cd Account',
            'nm_account' => 'Nm Account',
            'coa_type' => 'Coa Type',
            'normal_balance' => 'Normal Balance',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGlDetails()
    {
        return $this->hasMany(GlDetail::className(), ['id_coa' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntriSheetDtls()
    {
        return $this->hasMany(EntriSheetDtl::className(), ['id_coa' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoaParent()
    {
        return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoas()
    {
        return $this->hasMany(Coa::className(), ['id_coa_parent' => 'id_coa']);
    }

    /**
     * @return string
     */
    public function getNmCoaType()
    {
        return self::$_acc_type[$this->coa_type];
    }

    /**
     * @return array()
     */
    public static function getCoaType()
    {
        return self::$_acc_type;
    }

    /**
     * @return array()
     */
    public static function getBalanceType()
    {
        return self::$_balance_type;
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