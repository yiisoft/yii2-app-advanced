<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\purchase\models\PurchaseHdr;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\purchase\models\PurchaseHdrSearch $searchModel
 */
$this->title = 'Purchase Hdrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Purchase Hdr', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php yii\widgets\Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
	<?php
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'purchase_num',
			'idSupplier.nm_supplier',
			'idWarehouse.nm_whse',
			'purchase_date',
			'nmStatus',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete} {receive}',
				'buttons' => [
					'update' => function ($url, $model) {
						return $model->id_status == PurchaseHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
									'title' => Yii::t('yii', 'Update'),
									'data-pjax' => '0',
								]) : '';
					},
					'delete' => function ($url, $model) {
						return $model->id_status == PurchaseHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
									'title' => Yii::t('yii', 'Delete'),
									'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
									'data-method' => 'post',
									'data-pjax' => '0',
								]) : '';
					},
					'receive' => function ($url, $model) {
						return $model->id_status == PurchaseHdr::STATUS_DRAFT ? Html::a('<span class="glyphicon glyphicon-save"></span>', $url, [
									'title' => Yii::t('yii', 'Receive'),
									'data-confirm' => Yii::t('yii', 'Are you sure you want to Receive this item?'),
									'data-method' => 'post',
									'data-pjax' => '0',
								]) : '';
					}
				]
			],
		],
	]);
	?>
	<?php yii\widgets\Pjax::end(); ?>
</div>
