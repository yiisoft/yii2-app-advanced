<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "gl_header".
 *
 * @property integer $id_gl
 * @property string $gl_date
 * @property string $gl_num
 * @property string $gl_memo
 * @property integer $id_branch
 * @property integer $id_periode
 * @property integer $type_reff
 * @property integer $id_reff
 * @property string $description
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 * @property string $glDate
 *
 * @property GlDetail[] $glDetails
 * @property AccPeriode $idPeriode
 * @property Branch $idBranch
 */
class GlHeader extends \yii\db\ActiveRecord
{
    const TYPE_PURCHASE = 100;
    const TYPE_SALES = 200;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gl_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['glDate', 'id_branch', 'id_periode', 'description', 'status'], 'required'],
            [['description'], 'string'],
            [['gl_date'],'safe'],
            [['id_branch', 'id_periode', 'type_reff', 'id_reff', 'status'], 'integer'],
            [['gl_memo'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gl' => 'Id Gl',
            'gl_date' => 'Gl Date',
            'gl_num' => 'Gl Num',
            'gl_memo' => 'Gl Memo',
            'id_branch' => 'Id Branch',
            'id_periode' => 'Id Periode',
            'type_reff' => 'Type Reff',
            'id_reff' => 'Id Reff',
            'description' => 'Description',
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
    public function getGlDetails()
    {
        return $this->hasMany(GlDetail::className(), ['id_gl' => 'id_gl']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeriode()
    {
        return $this->hasOne(AccPeriode::className(), ['id_periode' => 'id_periode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBranch()
    {
        return $this->hasOne(Branch::className(), ['id_branch' => 'id_branch']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'biz\behaviors\AutoTimestamp',
            'biz\behaviors\AutoUser',
            [
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 4,
                'group' => 'gl',
                'attribute' => 'gl_num',
                'value' => 'GL'.date('ymd.?')
            ],
            [
                'class'=>'biz\behaviors\DateConverter',
                'physicalFormat'=>'Y-m-d H:i:s',
                'attributes'=>[
                    'glDate' => 'gl_date'
                ]
            ],
        ];
    }
}