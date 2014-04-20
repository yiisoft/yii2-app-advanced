<?php

namespace biz\accounting\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\accounting\models\AccPeriode;

/**
 * AccPeriodeSearch represents the model behind the search form about AccPeriode.
 */
class AccPeriodeSearch extends Model
{

    public $id_periode;
    public $id_branch;
    public $nm_periode;
    public $date_from;
    public $date_to;
    public $status;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_periode', 'id_branch', 'status', 'create_by', 'update_by'], 'integer'],
            [['nm_periode', 'date_from', 'date_to', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_periode' => 'Id Periode',
            'id_branch' => 'Id Branch',
            'nm_periode' => 'Nm Periode',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'status' => 'Status',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = AccPeriode::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_periode');
        $this->addCondition($query, 'id_branch');
        $this->addCondition($query, 'nm_periode', true);
        $this->addCondition($query, 'date_from');
        $this->addCondition($query, 'date_to');
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'create_date', true);
        $this->addCondition($query, 'create_by');
        $this->addCondition($query, 'update_date', true);
        $this->addCondition($query, 'update_by');
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
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
