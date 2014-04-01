<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\purchase\models\PurchaseHdr;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\purchase\models\PurchaseHdrSearch $searchModel
 */
$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Sales', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php yii\widgets\Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
	<?php
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'sales_num',
			'idCustomer.nm_cust',
			'idBranch.nm_branch',
			'sales_date',
                        'nmStatus',
			[
				'class' => 'yii\grid\ActionColumn',
				'buttons' => [
					
				]
			],
		],
	]);
	?>
	<?php yii\widgets\Pjax::end(); ?>
</div>
