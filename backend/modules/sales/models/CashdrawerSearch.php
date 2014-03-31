<?php

namespace backend\modules\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sales\models\Cashdrawer;

/**
 * CashdrawerSearch represents the model behind the search form about `backend\modules\sales\models\Cashdrawer`.
 */
class CashdrawerSearch extends Model
{
    public $id_cashdrawer;
    public $client_machine;
    public $id_branch;
    public $cashier_no;
    public $id_user;
    public $init_cash;
    public $close_cash;
    public $variants;
    public $status;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_cashdrawer', 'id_branch', 'cashier_no', 'id_user', 'status', 'create_by', 'update_by'], 'integer'],
            [['client_machine', 'init_cash', 'close_cash', 'variants', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cashdrawer' => 'Id Cashdrawer',
            'client_machine' => 'Client Machine',
            'id_branch' => 'Id Branch',
            'cashier_no' => 'Cashier No',
            'id_user' => 'Id User',
            'init_cash' => 'Init Cash',
            'close_cash' => 'Close Cash',
            'variants' => 'Variants',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = Cashdrawer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_cashdrawer');
        $this->addCondition($query, 'client_machine', true);
        $this->addCondition($query, 'id_branch');
        $this->addCondition($query, 'cashier_no');
        $this->addCondition($query, 'id_user');
        $this->addCondition($query, 'init_cash', true);
        $this->addCondition($query, 'close_cash', true);
        $this->addCondition($query, 'variants', true);
        $this->addCondition($query, 'status');
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
