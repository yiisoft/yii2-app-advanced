<?php

namespace biz\accounting\models;

/**
 * This is the model class for table "gl_header".
 *
 * @property integer $id_gl
 * @property integer $id_branch
 * @property string $gl_num
 * @property string $gl_date
 * @property string $gl_memo
 * @property integer $type_reff
 * @property integer $id_reff
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property GlDetail[] $glDetails
 */
class GlHeader extends \yii\db\ActiveRecord
{
    const TYPE_PURCHASE = 100;

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
            [['gl_date', 'id_branch'], 'required'],
            [['gl_date', 'gl_num'], 'string'],
            [['type_reff', 'id_reff', 'id_branch'], 'integer'],
            [['gl_num'], 'string', 'max' => 13],
            [['gl_memo'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gl' => 'Id Gl Header',
            'id_branch' => 'Id Branch',
            'gl_num' => 'GL Number',
            'gl_date' => 'Gl Date',
            'gl_memo' => 'Gl Memo',
            'type_reff' => 'Ref Type',
            'id_reff' => 'Ref ID',
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

    public function behaviors()
    {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser',
            [
                'class' => 'mdm\autonumber\Behavior',
                'digit' => 4,
                'group' => 'gl',
                'attribute' => 'gl_num',
                'value' => function($event) {
                return 'IN' . date('ymd.?');
            }
            ]
        ];
    }
}