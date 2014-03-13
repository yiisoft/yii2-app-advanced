<?php

namespace backend\modules\sales\components;

use yii\web\View;

/**
 * Description of SalesBehavior
 *
 * @author MDMunir
 */
class SalesBehavior extends \yii\base\Behavior
{

	public function events()
	{
		return [
			View::EVENT_END_PAGE => 'endPage',
		];
	}

	public function endPage($event)
	{
		/** @var View $view */
		$view = $this->owner;
		$bundels = $view->assetManager->bundles;
		foreach ($bundels as $bundel) {
			
		}
	}
}