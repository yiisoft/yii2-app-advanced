<?php

namespace biz\accounting\models;

use Yii;
use yii\base\UserException;

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
        ['normal_balance' => 'D', 'nm_balance' => 'DEBIT'],
        ['normal_balance' => 'K', 'nm_balance' => 'KREDIT'],
    ];

    /**
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
            [['cd_account', 'nm_account', 'coa_type', 'normal_balance'], 'required'],
            [['coa_type'], 'integer'],
            [['cd_account'], 'string', 'max' => 16],
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
    public function getGlDetails()
    {
        return $this->hasMany(GlDetail::className(), ['id_coa' => 'id_coa']);
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
    public function getCoaChilds()
    {
        return $this->hasMany(Coa::className(), ['id_coa_parent' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoas()
    {
        return $this->hasMany(Coa::className(), ['id_coa_parent' => 'id_coa']);
    }

    /**
     * @return array()
     */
    public static function getCoaType()
    {
        return self::$_acc_type;
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
    public static function getBalanceType()
    {
        return self::$_balance_type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntriSheetDtl()
    {
        return $this->hasOne(EntriSheetDtl::className(), ['id_coa' => 'id_coa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEsheets()
    {
        return $this->hasMany(EntriSheet::className(), ['id_esheet' => 'id_esheet'])->viaTable('entri_sheet_dtl', ['id_coa' => 'id_coa']);
    }

    public static function ListGCoas()
    {
        $sqli = 'SELECT id_coa, cd_account, nm_account FROM coa '
            . 'WHERE (cd_account::INT % 10000) = 0 ORDER BY cd_account ASC';
        $cmdi = \Yii::$app->db->createCommand($sqli);
        $dcol0 = $cmdi->queryColumn();
        $dval0 = $cmdi->queryAll();

        $query = new \yii\db\Query;
        $query->select('id_coa, cd_account, nm_account, id_coa_parent')
            ->from('coa')
            ->where(['in', 'id_coa_parent', $dcol0])
            ->orderBy('id_coa_parent,cd_account');

        $cmdr = $query->createCommand();
        $dvalr = $cmdr->queryAll();

        $result = [];
        foreach ($dval0 as $row) {
            $result[$row['nm_account']] = [];
            foreach ($dvalr as $rowd) {
                if ($row['id_coa'] == $rowd['id_coa_parent']) {
                    $result[$row['nm_account']][$rowd['id_coa']] = '[' . $rowd['cd_account'] . '] ' . $rowd['nm_account'];
                }
            }
        }
        return $result;
    }

    public function behaviors()
    {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser'
        ];
    }

}
