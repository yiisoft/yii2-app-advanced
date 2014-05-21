<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\TransferHdr as TransferHdrModel;

/**
 * TransferHdr represents the model behind the search form about `biz\models\TransferHdr`.
 */
class TransferHdr extends TransferHdrModel
{
    public function rules()
    {
        return [
            [['id_transfer', 'id_warehouse_source', 'id_warehouse_dest', 'status', 'create_by', 'update_by'], 'integer'],
            [['transfer_num', 'transfer_date', 'receive_date', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TransferHdrModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_transfer' => $this->id_transfer,
            'id_warehouse_source' => $this->id_warehouse_source,
            'id_warehouse_dest' => $this->id_warehouse_dest,
            'transfer_date' => $this->transfer_date,
            'receive_date' => $this->receive_date,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'transfer_num', $this->transfer_num])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
