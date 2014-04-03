<?php

namespace backend\modules\accounting\models;

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
 *
 * @property GlDetail[] $glDetails
 * @property Coa $idCoaParent
 * @property Coa[] $coas
 * @property EntriSheetDtl $entriSheetDtl
 * @property EntriSheet[] $idEsheets
 */
class Coa extends \yii\db\ActiveRecord {

    private static $_acc_type = [
        1000 => 'AKTIVA',
        4000 => 'KEWAJIBAN',
        5000 => 'MODAL',
        6000 => 'BIAYA',
        7000 => 'PENDAPATAN'
    ];
    private static $_balance_type = [
        ['normal_balance' => 'D', 'nm_balance' => 'DEBIT'],
        ['normal_balance' => 'K', 'nm_balance' => 'KREDIT'],
    ];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'coa';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cd_account', 'nm_account', 'coa_type', 'normal_balance'], 'required'],
            [['id_coa_parent', 'coa_type'], 'integer'],
            [['cd_account'], 'string', 'max' => 16],
            [['normal_balance'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_coa' => 'Id Coa',
            'id_coa_parent' => 'Id Coa Parent',
            'cd_account' => 'Account Code',
            'nm_account' => 'Account Name',
            'coa_type' => 'Account Type',
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
    public function getGlDetails() {
        return $this->hasMany(GlDetail::className(), ['id_coa' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoaParent() {
        return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoas() {
        return $this->hasMany(Coa::className(), ['id_coa_parent' => 'id_coa']);
    }

    /**
     * @return array()
     */
    public static function getCoaType() {
        return self::$_acc_type;
    }

    /**
     * @return string
     */
    public function getNmCoaType() {
        return self::$_acc_type[$this->coa_type];
    }
    
    /**
     * @return integer
     */
    public static function getAccountByName($name) {
        $coa = self::find(['lower(nm_account)'=>  strtolower($name)]);
        if($coa){
            return $coa->id_coa;
        }
        throw new \yii\base\UserException('Akun tidak ditemukan');
    }
    
    /**
     * @return integer
     */
    public static function getAccountByCode($code) {
        $coa = self::find(['lower(cd_account)'=>  strtolower($code)]);
        if($coa){
            return $coa->id_coa;
        }
        throw new \yii\base\UserException('Akun tidak ditemukan');
    }

    /**
     * @return array()
     */
    public static function getBalanceType() {
        return self::$_balance_type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntriSheetDtl() {
        return $this->hasOne(EntriSheetDtl::className(), ['id_coa' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEsheets() {
        return $this->hasMany(EntriSheet::className(), ['id_esheet' => 'id_esheet'])->viaTable('entri_sheet_dtl', ['id_coa' => 'id_coa']);
    }

    public function behaviors() {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser'
        ];
    }

}
