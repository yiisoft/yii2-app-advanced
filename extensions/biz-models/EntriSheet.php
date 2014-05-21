<?php

namespace biz\models;

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
 * @property EntriSheetDtl[] $entriSheetDtls
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
    public function getEntriSheetDtls()
    {
        return $this->hasMany(EntriSheetDtl::className(), ['id_esheet' => 'id_esheet']);
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