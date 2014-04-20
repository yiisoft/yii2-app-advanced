<?php

namespace biz\accounting\models;

use Yii;

/**
 * This is the model class for table "entri_sheet".
 *
 * @property integer $id_esheet
 * @property string $cd_esheet
 * @property string $nm_esheet
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property EntriSheetDtl $entriSheetDtl
 * @property Coa[] $idCoas
 */
class EntriSheet extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entri_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd_esheet', 'nm_esheet'], 'required'],
            [['cd_esheet'], 'string', 'max' => 4],
            [['nm_esheet'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_esheet' => 'Id Esheet',
            'cd_esheet' => 'Cd Esheet',
            'nm_esheet' => 'Nm Esheet',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntriSheetDtl()
    {
        return $this->hasMany(EntriSheetDtl::className(), ['id_esheet' => 'id_esheet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCoas()
    {
        return $this->hasMany(Coa::className(), ['id_coa' => 'id_coa'])->viaTable('entri_sheet_dtl', ['id_esheet' => 'id_esheet']);
    }

    public function behaviors()
    {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser'
        ];
    }

    public static function getGLMaps($nm_entrisheet, $values)
    {
        $gl_dtls = [];
        $esheet = self::find(['nm_esheet' => $nm_entrisheet]);
        if ($esheet) {
            foreach ($esheet->entriSheetDtl as $eDtl) {
                $coa = $eDtl->id_coa;
                $nm = $eDtl->nm_esheet_dtl;

                $dc = $eDtl->idCoa->normal_balance == 'D' ? 1 : -1;

                if (isset($values[$nm])) {
                    $ammount = $dc * $values[$nm];
                } else {
                    throw new \yii\base\UserException("Required account $nm ");
                }
                $gl_dtls[] = [
                    'id_coa' => $coa,
                    'ammount' => $ammount
                ];
            }
        } else {
            throw new \yii\base\UserException("Entrysheet $nm_entrisheet not found");
        }
        return $gl_dtls;
    }

}
