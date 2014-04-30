<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Supplier as SupplierModel;

/**
 * Supplier represents the model behind the search form about `biz\models\Supplier`.
 */
class Supplier extends SupplierModel
{
    public function rules()
    {
        return [
            [['id_supplier', 'create_by', 'update_by'], 'integer'],
            [['cd_supplier', 'nm_supplier', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SupplierModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_supplier' => $this->id_supplier,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'cd_supplier', $this->cd_supplier])
            ->andFilterWhere(['like', 'nm_supplier', $this->nm_supplier])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
