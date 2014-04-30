<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Orgn as OrgnModel;

/**
 * Orgn represents the model behind the search form about `biz\models\Orgn`.
 */
class Orgn extends OrgnModel
{
    public function rules()
    {
        return [
            [['id_orgn', 'create_by', 'update_by'], 'integer'],
            [['cd_orgn', 'nm_orgn', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = OrgnModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_orgn' => $this->id_orgn,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'cd_orgn', $this->cd_orgn])
            ->andFilterWhere(['like', 'nm_orgn', $this->nm_orgn])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
