<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "acc_periode".
 *
 * @property integer $id_periode
 * @property string $nm_periode
 * @property string $date_from
 * @property string $date_to
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property GlHeader[] $glHeaders
 */
class AccPeriode extends \yii\db\ActiveRecord
{
    const STATUS_OPEN = 0;
    const STATUS_CLOSE = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acc_periode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nm_periode', 'date_from', 'date_to'], 'required'],
            [['date_from', 'date_to'], 'safe'],
            [['status'], 'integer'],
            [['nm_periode'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_periode' => 'Id Periode',
            'nm_periode' => 'Nm Periode',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
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
    public function getGlHeaders()
    {
        return $this->hasMany(GlHeader::className(), ['id_periode' => 'id_periode']);
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