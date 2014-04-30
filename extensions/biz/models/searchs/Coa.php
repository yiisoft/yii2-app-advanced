<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Coa as CoaModel;

/**
 * Coa represents the model behind the search form about `biz\models\Coa`.
 */
class Coa extends CoaModel
{
    public function rules()
    {
        return [
            [['id_coa', 'id_coa_parent', 'coa_type', 'create_by', 'update_by'], 'integer'],
            [['cd_account', 'nm_account', 'normal_balance', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CoaModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_coa' => $this->id_coa,
            'id_coa_parent' => $this->id_coa_parent,
            'coa_type' => $this->coa_type,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'cd_account', $this->cd_account])
            ->andFilterWhere(['like', 'nm_account', $this->nm_account])
            ->andFilterWhere(['like', 'normal_balance', $this->normal_balance])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
