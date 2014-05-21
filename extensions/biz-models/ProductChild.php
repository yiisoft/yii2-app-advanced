<?php

namespace biz\models;

use Yii;

/**
 * This is the model class for table "product_child".
 *
 * @property string $barcode
 * @property integer $id_product
 * @property string $create_date
 * @property string $update_date
 * @property integer $create_by
 * @property integer $update_by
 * @property string $nm_product
 *
 * @property Product $idProduct
 */
class ProductChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['barcode', 'id_product', 'nm_product'], 'required'],
            [['id_product'], 'integer'],
            [['barcode'], 'string', 'max' => 13],
            [['nm_product'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'barcode' => 'Barcode',
            'id_product' => 'Id Product',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'nm_product' => 'Nm Product',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
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