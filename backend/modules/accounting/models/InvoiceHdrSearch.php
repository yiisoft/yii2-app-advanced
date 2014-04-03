<?php

namespace backend\modules\accounting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\accounting\models\InvoiceHdr;

/**
 * InvoiceHdrSearch represents the model behind the search form about `backend\modules\accounting\models\InvoiceHdr`.
 */
class InvoiceHdrSearch extends Model
{
    public $id_invoice;
    public $inv_num;
    public $type;
    public $inv_date;
    public $id_vendor;
    public $inv_value;
    public $create_date;
    public $create_by;
    public $update_date;
    public $update_by;

    public function rules()
    {
        return [
            [['id_invoice', 'type', 'id_vendor', 'create_by', 'update_by'], 'integer'],
            [['inv_num', 'inv_date', 'inv_value', 'create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_invoice' => 'Id Invoice',
            'inv_num' => 'Inv Num',
            'type' => 'Type',
            'inv_date' => 'Inv Date',
            'id_vendor' => 'Id Vendor',
            'inv_value' => 'Inv Value',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'update_date' => 'Update Date',
            'update_by' => 'Update By',
        ];
    }

    public function search($params)
    {
        $query = InvoiceHdr::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id_invoice');
        $this->addCondition($query, 'inv_num', true);
        $this->addCondition($query, 'type');
        $this->addCondition($query, 'inv_date');
        $this->addCondition($query, 'id_vendor');
        $this->addCondition($query, 'inv_value', true);
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
