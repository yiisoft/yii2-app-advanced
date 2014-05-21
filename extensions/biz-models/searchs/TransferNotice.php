<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\TransferNotice as TransferNoticeModel;

/**
 * TransferNotice represents the model behind the search form about `biz\models\TransferNotice`.
 */
class TransferNotice extends TransferNoticeModel
{
    public function rules()
    {
        return [
            [['id_transfer', 'status', 'update_by', 'create_by'], 'integer'],
            [['notice_date', 'description', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TransferNoticeModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_transfer' => $this->id_transfer,
            'notice_date' => $this->notice_date,
            'status' => $this->status,
            'update_by' => $this->update_by,
            'create_by' => $this->create_by,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
