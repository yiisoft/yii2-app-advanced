<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\ProductUom as ProductUomModel;

/**
 * ProductUom represents the model behind the search form about `biz\models\ProductUom`.
 */
class ProductUom extends ProductUomModel
{
    public function rules()
    {
        return [
            [['id_puom', 'id_product', 'id_uom', 'isi', 'create_by', 'update_by'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ProductUomModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_puom' => $this->id_puom,
            'id_product' => $this->id_product,
            'id_uom' => $this->id_uom,
            'isi' => $this->isi,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
