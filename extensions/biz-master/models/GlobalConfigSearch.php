<?php

namespace biz\master\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use biz\master\models\GlobalConfig;

/**
 * GlobalConfigSearch represents the model behind the search form about `biz\master\models\GlobalConfig`.
 */
class GlobalConfigSearch extends Model
{
    public $config_group;
    public $config_name;
    public $config_value;
    public $description;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['config_group', 'config_name', 'config_value', 'description', 'create_date', 'update_date'], 'safe'],
            [['create_by', 'update_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'config_group' => 'Config Group',
            'config_name' => 'Config Name',
            'config_value' => 'Config Value',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = GlobalConfig::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'config_group', true);
        $this->addCondition($query, 'config_name', true);
        $this->addCondition($query, 'config_value', true);
        $this->addCondition($query, 'description', true);
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
