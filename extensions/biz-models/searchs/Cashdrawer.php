<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Cashdrawer as CashdrawerModel;

/**
 * Cashdrawer represents the model behind the search form about `biz\models\Cashdrawer`.
 */
class Cashdrawer extends CashdrawerModel
{
    public function rules()
    {
        return [
            [['id_cashdrawer', 'id_branch', 'cashier_no', 'id_user', 'status', 'create_by', 'update_by'], 'integer'],
            [['client_machine', 'create_date', 'update_date'], 'safe'],
            [['init_cash', 'close_cash', 'variants'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CashdrawerModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_cashdrawer' => $this->id_cashdrawer,
            'client_machine' => $this->client_machine,
            'id_branch' => $this->id_branch,
            'cashier_no' => $this->cashier_no,
            'id_user' => $this->id_user,
            'init_cash' => $this->init_cash,
            'close_cash' => $this->close_cash,
            'variants' => $this->variants,
            'status' => $this->status,
            'create_date' => $this->create_date,
            'create_by' => $this->create_by,
            'update_date' => $this->update_date,
            'update_by' => $this->update_by,
        ]);

        return $dataProvider;
    }
}
