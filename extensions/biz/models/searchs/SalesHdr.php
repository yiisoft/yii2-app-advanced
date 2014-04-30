<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\SalesHdr as SalesHdrModel;

/**
 * SalesHdr represents the model behind the search form about `biz\models\SalesHdr`.
 */
class SalesHdr extends SalesHdrModel
{
    public function rules()
    {
        return [
            [['id_sales', 'id_branch', 'id_customer', 'id_cashdrawer', 'status', 'create_by', 'update_by'], 'integer'],
            [['sales_num', 'discount', 'sales_date', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SalesHdrModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_sales' => $this->id_sales,
            'id_branch' => $this->id_branch,
            'id_customer' => $this->id_customer,
            'id_cashdrawer' => $this->id_cashdrawer,
            'sales_date' => $this->sales_date,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'sales_num', $this->sales_num])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
