<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventory\models\TransferHdr;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\purchase\models\PurchaseHdrSearch $searchModel
 */
$this->title = 'Receive';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
	<?php
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'transfer_num',
			'idWarehouseSource.nm_whse',
			'idWarehouseDest.nm_whse',
			'transfer_date',
			'nmStatus',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {receive}',
				'buttons' => [
					'update' => function ($url, $model) {
						$allowUpdate = [TransferHdr::STATUS_ISSUE,TransferHdr::STATUS_CONFIRM_REJECT];
						return in_array($model->status, $allowUpdate) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
									'title' => Yii::t('yii', 'Update'),
									'data-pjax' => '0',
								]) : '';
					},
					'receive' => function ($url, $model) {
						$url = ['receive-confirm', 'id' => $model->id_transfer];
						return $model->status == TransferHdr::STATUS_CONFIRM_APPROVE ? Html::a('<span class="glyphicon glyphicon-save"></span>', $url, [
									'title' => Yii::t('yii', 'Receive'),
									'data-confirm' => Yii::t('yii', 'Are you sure you want to receive this item?'),
									'data-method' => 'post',
									'data-pjax' => '0',
								]) : '';
					}
				]
			],
		],
	]);
	?>
	<?php Pjax::end(); ?>
</div>
