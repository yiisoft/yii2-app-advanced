<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\GlobalConfig as GlobalConfigModel;

/**
 * GlobalConfig represents the model behind the search form about `biz\models\GlobalConfig`.
 */
class GlobalConfig extends GlobalConfigModel
{
    public function rules()
    {
        return [
            [['config_group', 'config_name', 'config_value', 'description', 'create_date', 'update_date'], 'safe'],
            [['create_by', 'update_by'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = GlobalConfigModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'config_group', $this->config_group])
            ->andFilterWhere(['like', 'config_name', $this->config_name])
            ->andFilterWhere(['like', 'config_value', $this->config_value])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
