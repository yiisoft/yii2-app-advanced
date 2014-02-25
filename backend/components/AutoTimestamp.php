<?php
namespace backend\components;

use yii\db\Expression;
use yii\db\ActiveRecord;


/**
 * Description of AutoTimestamp
 *
 * @author MDMunir
 */
class AutoTimestamp extends \yii\behaviors\TimestampBehavior
{
	public $attributes = [
		ActiveRecord::EVENT_BEFORE_INSERT => ['create_date','update_date'],
		ActiveRecord::EVENT_BEFORE_UPDATE => ['update_date'],
	];
	
	public function init()
	{
		$this->value = new Expression('NOW()');
		parent::init();
	}
}