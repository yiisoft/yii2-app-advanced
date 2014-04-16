<?php

namespace biz\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\PriceCategory;

/**
 * PriceCategorySearch represents the model behind the search form about `biz\master\models\PriceCategory`.
 */
class PriceCategorySearch extends Model
{
    public $id_price_category;
    public $nm_price_category;
    public $formula;
    public $create_by;
    public $update_date;
    public $update_by;
    public $create_date;

    public function rules()
    {
        return [
            [['id_price_category', 'create_by', 'update_by'], 'integer'],
            [['nm_price_category', 'formula', 'update_date', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_price_category' => 'Id Price Category',
            'nm_price_category' => 'Nm Price Category',
            'formula' => 'Formula',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
            'create_date' => 'Create Date',
        ];
    }

    public function search($params)
    {
        $query = PriceCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_price_category');
        $this->addCondition($query, 'nm_price_category', true);
        $this->addCondition($query, 'formula', true);
        $this->addCondition($query, 'create_by');
        $this->addCondition($query, 'update_date', true);
        $this->addCondition($query, 'update_by');
        $this->addCondition($query, 'create_date', true);
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
