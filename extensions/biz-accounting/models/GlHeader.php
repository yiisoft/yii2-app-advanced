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
use yii\base\UserException;

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

    public static function createDocument($header, $details, $in_transaction = false)
    {
        if ($in_transaction) {
            $transaction = \Yii::$app->db->beginTransaction();
        }
        try {
            $hdr = new self();
            $hdr->load($header, '');
            if (!$hdr->gl_date) {
                $hdr->gl_date = new \yii\db\Expression('NOW()');
            }
            $err = [];
            $success = $hdr->save();
            if ($success) {
                $total = 0.0;
                $id_header = $hdr->id_gl;
                foreach ($details as $detail) {
                    $dtl = new GlDetail();
                    $coa = Coa::find($detail['id_coa']);
                    if ($coa->normal_position == Coa::POSITION_DEBET) {
                        $amount = $detail['amount'];
                    } else {
                        $amount = -$detail['amount'];
                    }
                    $total += $amount;
                    $dtl->id_gl = $id_header;
                    $dtl->id_coa = $detail['id_coa'];
                    $dtl->amount = $amount;
                    $success = $success && $dtl->save();
                    if (!$success) {
                        $err = array_merge($err, $dtl->firstErrors);
                        break;
                    }
                }
                if ($success && $total != 0.0) {
                    $err[] = 'Not balance...';
                    $success = false;
                }
            }
            if ($success) {
                if ($in_transaction) {
                    $transaction->commit();
                }
                return true;
            } else {
                throw new \yii\base\UserException(implode("\n", $err));
            }
        } catch (\Exception $exc) {
            if ($in_transaction) {
                $transaction->rollback();
                return false;
            } else {
                throw $exc;
            }
        }
    }

    public function behaviors()
    {
        return [
            'backend\components\AutoTimestamp',
            'backend\components\AutoUser',
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

    public static function createGL($hdr, $dtls = [])
    {
        $blc = 0.0;
        foreach ($dtls as $row) {
            $blc += $row['ammount'];
        }
        if ($blc != 0) {
            throw new UserException('GL Balance Failed');
        }

        $gl = new self();
        $gl->gl_date = $hdr['date'];
        $gl->id_reff = $hdr['id_reff'];
        $gl->type_reff = $hdr['type_reff'];
        $gl->gl_memo = $hdr['memo'];
        $gl->description = $hdr['description'];
        
        $gl->id_branch = $hdr['id_branch'];
        $gl->id_periode = 1;
        $gl->status = 0;
        if (!$gl->save()) {
            throw new UserException(implode("\n", $gl->getFirstErrors()));
        }

        foreach ($dtls as $row) {
            $glDtl = new GlDetail();
            $glDtl->id_gl = $gl->id_gl;
            $glDtl->id_coa = $row['id_coa'];
            $glDtl->amount = $row['ammount'];
            if (!$glDtl->save()) {
                throw new UserException(implode("\n", $glDtl->getFirstErrors()));
            }
        }
    }

}
