<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\PurchaseHdr as PurchaseHdrModel;

/**
 * PurchaseHdr represents the model behind the search form about `biz\models\PurchaseHdr`.
 */
class PurchaseHdr extends PurchaseHdrModel
{
    public function rules()
    {
        return [
            [['id_purchase', 'id_supplier', 'id_branch', 'status', 'create_by', 'update_by'], 'integer'],
            [['purchase_num', 'purchase_date', 'purchase_value', 'item_discount', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PurchaseHdrModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_purchase' => $this->id_purchase,
            'id_supplier' => $this->id_supplier,
            'id_branch' => $this->id_branch,
            'purchase_date' => $this->purchase_date,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'purchase_num', $this->purchase_num])
            ->andFilterWhere(['like', 'purchase_value', $this->purchase_value])
            ->andFilterWhere(['like', 'item_discount', $this->item_discount])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
