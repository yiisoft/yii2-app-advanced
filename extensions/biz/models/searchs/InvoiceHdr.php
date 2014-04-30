<?php

namespace biz\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\models\InvoiceHdr as InvoiceHdrModel;

/**
 * InvoiceHdr represents the model behind the search form about `biz\models\InvoiceHdr`.
 */
class InvoiceHdr extends InvoiceHdrModel
{
    public function rules()
    {
        return [
            [['id_invoice', 'type', 'id_vendor', 'status', 'create_by', 'update_by'], 'integer'],
            [['inv_num', 'inv_date', 'due_date', 'inv_value', 'create_date', 'update_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = InvoiceHdrModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_invoice' => $this->id_invoice,
            'type' => $this->type,
            'inv_date' => $this->inv_date,
            'due_date' => $this->due_date,
            'id_vendor' => $this->id_vendor,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'inv_num', $this->inv_num])
            ->andFilterWhere(['like', 'inv_value', $this->inv_value])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'update_date', $this->update_date]);

        return $dataProvider;
    }
}
