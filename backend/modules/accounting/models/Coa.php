<?php

namespace backend\modules\accounting\models;

use Yii;

/**
 * This is the model class for table "coa".
 *
 * @property integer $id_coa
 * @property integer $id_coa_parent
 * @property string $cd_account
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
            [['cd_account', 'coa_type', 'normal_balance'], 'required'],
            [['id_coa_parent', 'coa_type'], 'integer'],
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
            'cd_account' => 'Cd Account',
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
    
    	public function behaviors()
	{
		return [
			'backend\components\AutoTimestamp',
			'backend\components\AutoUser'
		];
	}
}
