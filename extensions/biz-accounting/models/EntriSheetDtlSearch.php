<?php

namespace biz\accounting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\accounting\models\EntriSheetDtl;

/**
 * EntriSheetDtlSearch represents the model behind the search form about `biz\accounting\models\EntriSheetDtl`.
 */
class EntriSheetDtlSearch extends Model
{
    public $id_esheet;
    public $id_coa;
    public $dk;

    public function rules()
    {
        return [
            [['id_esheet', 'id_coa'], 'integer'],
            [['dk'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_esheet' => 'Id Esheet',
            'id_coa' => 'Id Coa',
            'dk' => 'Dk',
        ];
    }

    public function search($params)
    {
        $query = EntriSheetDtl::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_esheet');
        $this->addCondition($query, 'id_coa');
        $this->addCondition($query, 'dk', true);
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
