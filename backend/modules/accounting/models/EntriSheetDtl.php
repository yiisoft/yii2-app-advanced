<?php

namespace backend\modules\accounting\models;

use Yii;

/**
 * This is the model class for table "entri_sheet_dtl".
 *
 * @property integer $id_esheet
 * @property integer $id_coa
 * @property string $dk
 *
 * @property EntriSheet $idEsheet
 * @property Coa $idCoa
 */
class EntriSheetDtl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'entri_sheet_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_esheet', 'id_coa', 'dk'], 'required'],
            [['id_esheet', 'id_coa'], 'integer'],
            [['dk'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_esheet' => 'Id Esheet',
            'id_coa' => 'Id Coa',
            'dk' => 'Dk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEsheet() {
        return $this->hasOne(EntriSheet::className(), ['id_esheet' => 'id_esheet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoa() {
        return $this->hasOne(Coa::className(), ['id_coa' => 'id_coa']);
    }

    public function behaviors() {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser'
        ];
    }

}
