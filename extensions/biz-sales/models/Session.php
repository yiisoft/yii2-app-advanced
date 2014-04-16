<?php
namespace biz\sales\models;
/**
 * Description of Session
 *
 * @author MDMunir
 */
class Session extends \yii\base\Model
{
	public $no_cashier;
	public $name_cashier;
	public $initial_cash;
	
	public function rules()
	{
		return [
			[['no_cashier','initial_cash'],'safe'],
		];
	}
}