<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "entri_sheet_dtl".
 *
 * @property integer $id_esheet
 * @property string $nm_esheet_dtl
 * @property integer $id_coa
 *
 * @property EntriSheet $idEsheet
 * @property Coa $idCoa
 */
class EntriSheetDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entri_sheet_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_esheet', 'nm_esheet_dtl', 'id_coa'], 'required'],
            [['id_esheet', 'id_coa'], 'integer'],
            [['nm_esheet_dtl'], 'string'],
            [['id_esheet', 'id_coa'], 'unique', 'targetAttribute' => ['id_esheet', 'id_coa'], 'message' => 'The combination of Id Esheet and Id Coa has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_esheet' => 'Id Esheet',
            'nm_esheet_dtl' => 'Nm Esheet Dtl',
            'id_coa' => 'Id Coa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEsheet()
    {
        return $this->hasOne(EntriSheet::className(), ['id_esheet' => 'id_esheet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoa()
    {
        return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa']);
    }
}