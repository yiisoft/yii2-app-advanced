<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\inventory\models\TransferHdr;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdr $model
 */
$this->title = $model->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Inventory Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-hdr-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?php if ($model->id_status == TransferHdr::STATUS_DRAFT): ?>
			<?= Html::a('Update', ['update', 'id' => $model->id_transfer_hdr], ['class' => 'btn btn-primary']) ?>
			<?php
			echo Html::a('Delete', ['delete', 'id' => $model->id_transfer_hdr], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Are you sure to delete this item?'),
					'method' => 'post',
				],
			]);
			?>
		<?php endif; ?>
		<?php
		switch ($model->id_status) {
			case TransferHdr::STATUS_DRAFT:
				echo Html::a('Release', ['issue', 'id' => $model->id_transfer_hdr], [
					'class' => 'btn btn-primary',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure to release this item?'),
						'method' => 'post',
					],
				]);
				break;

			case TransferHdr::STATUS_CONFIRM:
				echo Html::a('Approve', ['confirm', 'id' => $model->id_transfer_hdr, 'confirm' => TransferHdr::STATUS_CONFIRM_APPROVE], [
					'class' => 'btn btn-primary',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure to approve this item?'),
						'method' => 'post',
					],
				]) . ' ';
				echo Html::a('Reject', ['confirm', 'id' => $model->id_transfer_hdr, 'confirm' => TransferHdr::STATUS_CONFIRM_REJECT], [
					'class' => 'btn btn-primary',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure to reject this item?'),
						'method' => 'post',
					],
				]);
				break;

			default:
				break;
		}
		?>
	</p>

	<?php
	echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'idBranch.nm_branch',
			'transfer_num',
			'idWarehouseSource.nm_whse',
			'idWarehouseDest.nm_whse',
			'transfer_date',
			'nmStatus',
		],
	]);

	echo GridView::widget([
		'dataProvider' => new ActiveDataProvider([
			'query' => $model->getTransferDtls(),
			'sort' => false,
			'pagination' => false,
				]),
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'idProduct.nm_product',
			'transfer_qty_send',
			'transfer_qty_receive',
			['label' => 'Selisih', 'value' => function($model) {
					return $model->transfer_qty_receive - $model->transfer_qty_send;
				}],
			'idUom.nm_uom'
		]
	]);
	?>

</div>
