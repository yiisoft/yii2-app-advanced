<?php

namespace backend\modules\accounting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\accounting\models\Coa;

/**
 * CoaSearch represents the model behind the search form about `backend\modules\accounting\models\Coa`.
 */
class CoaSearch extends Model
{
    public $id_coa;
    public $id_coa_parent;
    public $cd_account;
    public $coa_type;
    public $normal_balance;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_coa', 'id_coa_parent', 'coa_type', 'create_by', 'update_by'], 'integer'],
            [['cd_account', 'normal_balance', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_coa' => 'Id Coa',
            'id_coa_parent' => 'Id Coa Parent',
            'cd_account' => 'Cd Account',
            'coa_type' => 'Coa Type',
            'normal_balance' => 'Normal Balance',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = Coa::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_coa');
        $this->addCondition($query, 'id_coa_parent');
        $this->addCondition($query, 'cd_account', true);
        $this->addCondition($query, 'coa_type');
        $this->addCondition($query, 'normal_balance', true);
        $this->addCondition($query, 'create_date', true);
        $this->addCondition($query, 'create_by');
        $this->addCondition($query, 'update_date', true);
        $this->addCondition($query, 'update_by');
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
