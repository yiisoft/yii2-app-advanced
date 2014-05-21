<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\PriceCategory as PriceCategoryModel;

/**
 * PriceCategory represents the model behind the search form about `biz\models\PriceCategory`.
 */
class PriceCategory extends PriceCategoryModel
{
    public function rules()
    {
        return [
            [['id_price_category', 'create_by', 'update_by'], 'integer'],
            [['nm_price_category', 'formula', 'update_date', 'create_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PriceCategoryModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_price_category' => $this->id_price_category,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'nm_price_category', $this->nm_price_category])
            ->andFilterWhere(['like', 'formula', $this->formula])
            ->andFilterWhere(['like', 'update_date', $this->update_date])
            ->andFilterWhere(['like', 'create_date', $this->create_date]);

        return $dataProvider;
    }
}
