<?php

namespace biz\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\Price;

/**
 * PriceSearch represents the model behind the search form about `biz\master\models\Price`.
 */
class PriceSearch extends Model
{
    public $id_product;
    public $id_price_category;
    public $id_uom;
    public $price;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_product', 'id_price_category', 'id_uom', 'create_by', 'update_by'], 'integer'],
            [['price', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'id_price_category' => 'Id Price Category',
            'id_uom' => 'Id Uom',
            'price' => 'Price',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = Price::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_product');
        $this->addCondition($query, 'id_price_category');
        $this->addCondition($query, 'id_uom');
        $this->addCondition($query, 'price', true);
        $this->addCondition($query, 'create_date', true);
        $this->addCondition($query, 'create_by');
        $this->addCondition($query, 'update_date', true);
        $this->addCondition($query, 'update_by');
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
