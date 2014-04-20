<?php

namespace biz\accounting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\accounting\models\EntriSheet;

/**
 * EntriSheetSearch represents the model behind the search form about `biz\accounting\models\EntriSheet`.
 */
class EntriSheetSearch extends Model
{

    public $id_esheet;
    public $cd_esheet;
    public $nm_esheet;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_esheet', 'create_by', 'update_by'], 'integer'],
            [['cd_esheet', 'nm_esheet', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_esheet' => 'Id Esheet',
            'cd_esheet' => 'Cd Esheet',
            'nm_esheet' => 'Nm Esheet',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = EntriSheet::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_esheet');
        $this->addCondition($query, 'cd_esheet', true);
        $this->addCondition($query, 'nm_esheet', true);
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
