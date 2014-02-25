<?php

namespace common\extensions\inputGrid;

use yii\helpers\Html;
use \Yii;

/**
 * Description of ActionColumn
 *
 * @author MDMunir
 */
class ActionColumn extends \yii\grid\Column
{

	protected function renderHeaderCellContent()
	{
		return Html::a('<span class="glyphicon glyphicon-plus"></span>', '#', [
					'title' => Yii::t('yii', 'Add'),
					'data-action' => 'add',
		]);
	}

	protected function renderDataCellContent($model, $key, $index)
	{
		return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
					'title' => Yii::t('yii', 'Delete'),
					'data-action' => 'delete',
		]);
	}

}