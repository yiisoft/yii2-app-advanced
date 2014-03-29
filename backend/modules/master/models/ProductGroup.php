<?php

namespace backend\modules\master\models;

use Yii;

/**
 * This is the model class for table "product_group".
 *
 * @property integer $id_group
 * @property string $cd_group
 * @property string $nm_group
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 *
 * @property Product[] $products
 */
class ProductGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd_group', 'nm_group', 'create_date', 'create_by', 'update_date', 'update_by'], 'required'],
            [['create_date', 'update_date'], 'string'],
            [['create_by', 'update_by'], 'integer'],
            [['cd_group'], 'string', 'max' => 4],
            [['nm_group'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_group' => 'Id Group',
            'cd_group' => 'Cd Group',
            'nm_group' => 'Nm Group',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id_group' => 'id_group']);
    }
}
