<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Customer as CustomerModel;

/**
 * Customer represents the model behind the search form about `biz\models\Customer`.
 */
class Customer extends CustomerModel
{
    public function rules()
    {
        return [
            [['id_customer', 'update_by', 'create_by'], 'integer'],
            [['cd_cust', 'nm_cust', 'contact_name', 'contact_number', 'status', 'update_date', 'create_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CustomerModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_customer' => $this->id_customer,
            'update_by' => $this->update_by,
            'create_by' => $this->create_by,
        ]);

        $query->andFilterWhere(['like', 'cd_cust', $this->cd_cust])
            ->andFilterWhere(['like', 'nm_cust', $this->nm_cust])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'update_date', $this->update_date])
            ->andFilterWhere(['like', 'create_date', $this->create_date]);

        return $dataProvider;
    }
}
