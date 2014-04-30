<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\Uom as UomModel;

/**
 * Uom represents the model behind the search form about `biz\models\Uom`.
 */
class Uom extends UomModel
{
    public function rules()
    {
        return [
            [['id_uom', 'create_by', 'update_by'], 'integer'],
            [['cd_uom', 'nm_uom', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UomModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_uom' => $this->id_uom,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'cd_uom', $this->cd_uom])
            ->andFilterWhere(['like', 'nm_uom', $this->nm_uom])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
