<?php

namespace biz\master\models;

/**
 * This is the model class for table "cogs".
 *
 * @property integer $id_cogs
 * @property integer $id_product
 * @property integer $id_uom
 * @property string $cogs
 * @property string $update_date
 * @property integer $create_by
 * @property string $create_date
 * @property integer $update_by
 *
 * @property Uom $idUom
 * @property Product $idProduct
 */
class Cogs extends \yii\db\ActiveRecord
{

    const COLLECTION_NAME = 'log_cogs';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cogs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_uom', 'cogs'], 'required'],
            [['id_product', 'id_uom'], 'integer'],
            [['cogs'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cogs' => 'Id Cogs',
            'id_product' => 'Id Product',
            'id_uom' => 'Id Uom',
            'cogs' => 'Cogs',
            'update_date' => 'Update Date',
            'create_by' => 'Create By',
            'create_date' => 'Create Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUom()
    {
        return $this->hasOne(Uom::className(), ['id_uom' => 'id_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
    }

    public function behaviors()
    {
        return [
            'app\tools\AutoTimestamp',
            'app\tools\AutoUser',
            [
                'class' => 'mdm\tools\Logger',
                'collectionName' => self::COLLECTION_NAME,
                'attributes' => ['id_product', 'id_uom', 'cogs'],
            ]
        ];
    }

}
