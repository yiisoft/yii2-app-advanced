<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\modules\inventory\models\TransferHdr;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdr $model
 */
$this->title = $model->transfer_num;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-hdr-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?php
		switch ($model->id_status) {
			case TransferHdr::STATUS_ISSUE:
			case TransferHdr::STATUS_DRAFT_RECEIVE:
				echo Html::a('Update', ['update', 'id' => $model->id_transfer_hdr], ['class' => 'btn btn-primary']) . ' ';
			case TransferHdr::STATUS_CONFIRM_APPROVE:
				echo Html::a('Receive', ['receive', 'id' => $model->id_transfer_hdr], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure to receive this item?'),
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
			['attribute' => 'idWarehouseSource.nm_whse', 'label' => 'Gudang Asal'],
			['attribute' => 'idWarehouseDest.nm_whse', 'label' => 'Gudang Tujuan'],
			'transfer_date',
			'nmStatus',
		],
	]);
	?>
	<?php
	echo GridView::widget([
		'dataProvider' => new ActiveDataProvider([
			'sort' => false,
			'pagination' => false,
			'query' => $model->getTransferDtls()
				]),
		'columns' => [
			'idProduct.nm_product',
			'transfer_qty_send',
			'transfer_qty_receive',
			['label' => 'Selisih',
				'value' => function($model) {
					return $model->transfer_qty_receive - $model->transfer_qty_send;
				}],
			'idUom.nm_uom',
		]
	]);
	?>
</div>
