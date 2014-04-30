<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "transfer_notice".
 *
 * @property integer $id_transfer
 * @property string $notice_date
 * @property string $description
 * @property integer $status
 * @property integer $update_by
 * @property integer $create_by
 * @property string $create_date
 * @property string $update_date
 *
 * @property NoticeDtl $noticeDtl
 * @property Product[] $idProducts
 * @property TransferHdr $idTransfer
 */
class TransferNotice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_transfer', 'notice_date', 'description', 'status'], 'required'],
            [['id_transfer', 'status'], 'integer'],
            [['notice_date'], 'safe'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_transfer' => 'Id Transfer',
            'notice_date' => 'Notice Date',
            'description' => 'Description',
            'status' => 'Status',
            'update_by' => 'Update By',
            'create_by' => 'Create By',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticeDtl()
    {
        return $this->hasOne(NoticeDtl::className(), ['id_transfer' => 'id_transfer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducts()
    {
        return $this->hasMany(Product::className(), ['id_product' => 'id_product'])->viaTable('notice_dtl', ['id_transfer' => 'id_transfer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransfer()
    {
        return $this->hasOne(TransferHdr::className(), ['id_transfer' => 'id_transfer']);
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