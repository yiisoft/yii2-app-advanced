<?php
namespace backend\modules\sales\models;
/**
 * Description of Session
 *
 * @author MDMunir
 */
class Session extends \yii\base\Model
{
	public $no_cashier;
	public $initial;
	
	public function rules()
	{
		return [
			[['no_cashier','initial'],'safe'],
		];
	}
}