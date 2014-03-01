<?php

namespace backend\components;

use backend\models\AutoNumber as ArAutoNumber;
use yii\db\Expression;
use yii\db\StaleObjectException;

/**
 * Description of AutoNumber
 *
 * @author MDMunir
 */
class AutoNumber extends \yii\behaviors\AttributeBehavior
{

	public $digit;

	protected function getValue($event)
	{
		$value = parent::getValue($event);

		$now = new Expression('NOW()');
		do {
			$repeat = false;
			try {
				$ar = ArAutoNumber::find($value);
				if ($ar) {
					$number = $ar->auto_number + 1;
				} else {
					$ar = new ArAutoNumber;
					$ar->template_num = $value;
					$number = 1;
				}
				$ar->update_date = $now;
				$ar->auto_number = $number;
				$ar->save();
			} catch (\Exception $exc) {
				if ($exc instanceof StaleObjectException) {
					$repeat = true;
				} else {
					throw $exc;
				}
			}
		} while ($repeat);
		return str_replace('?', $this->digit ? sprintf("%0{$this->digit}d", $number) : $number, $value);
	}

}