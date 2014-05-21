<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\CustomerDetail as CustomerDetailModel;

/**
 * CustomerDetail represents the model behind the search form about `biz\models\CustomerDetail`.
 */
class CustomerDetail extends CustomerDetailModel
{
    public function rules()
    {
        return [
            [['id_customer', 'id_distric', 'id_kab', 'id_kec', 'id_kel', 'create_by', 'update_by'], 'integer'],
            [['addr1', 'addr2', 'latitude', 'longtitude', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CustomerDetailModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_customer' => $this->id_customer,
            'id_distric' => $this->id_distric,
            'id_kab' => $this->id_kab,
            'id_kec' => $this->id_kec,
            'id_kel' => $this->id_kel,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'addr1', $this->addr1])
            ->andFilterWhere(['like', 'addr2', $this->addr2])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longtitude', $this->longtitude])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
