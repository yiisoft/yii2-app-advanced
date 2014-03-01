<?php
namespace backend\models;
/**
 * Description of MTest
 *
 * @author MDMunir
 */
class MTest extends \yii\base\Model
{
	//put your code here
	public $test;

	public function behaviors()
	{
		return[
			'checkReload'=>'backend\models\CheckReload',
		];
	}

	public function rules()
	{
		return [
			['test','safe'],
		];
	}
	
}