<?php
namespace backend\components;

use yii\db\Expression;
use yii\db\ActiveRecord;


/**
 * Description of AutoTimestamp
 *
 * @author MDMunir
 */
class AutoTimestamp extends \yii\behaviors\AutoTimestamp
{
	public $attributes = [
		ActiveRecord::EVENT_BEFORE_INSERT => ['create_date','update_date'],
		ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_date',
	];
	
	public function init()
	{
		parent::init();
		$this->timestamp = new Expression('NOW()');
	}
}