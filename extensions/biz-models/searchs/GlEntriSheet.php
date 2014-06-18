<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\GlHeader;

/**
 * GlEntriSheet represents the model behind the search form about `biz\models\GlHeader`.
 */
class GlEntriSheet extends GlHeader
{
    public function rules()
    {
        return [
            [['id_gl', 'id_branch', 'id_periode', 'type_reff', 'id_reff', 'status', 'create_by', 'update_by'], 'integer'],
            [['gl_date', 'gl_num', 'gl_memo', 'description', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = GlHeader::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_gl' => $this->id_gl,
            'gl_date' => $this->gl_date,
            'id_branch' => $this->id_branch,
            'id_periode' => $this->id_periode,
            'type_reff' => $this->type_reff,
            'id_reff' => $this->id_reff,
            'status' => $this->status,
            'create_date' => $this->create_date,
            'create_by' => $this->create_by,
            'update_date' => $this->update_date,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'gl_num', $this->gl_num])
            ->andFilterWhere(['like', 'gl_memo', $this->gl_memo])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
