<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Branch as BranchModel;

/**
 * Branch represents the model behind the search form about `biz\models\Branch`.
 */
class Branch extends BranchModel
{
    public function rules()
    {
        return [
            [['id_branch', 'id_orgn', 'create_by', 'update_by'], 'integer'],
            [['cd_branch', 'nm_branch', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BranchModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_branch' => $this->id_branch,
            'id_orgn' => $this->id_orgn,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'cd_branch', $this->cd_branch])
            ->andFilterWhere(['like', 'nm_branch', $this->nm_branch])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
