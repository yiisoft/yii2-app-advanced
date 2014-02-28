<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\inventory\models\TransferHdr;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdr $model
 */
$this->title = $model->id_transfer_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Hdrs', 'url' => ['index']];
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
			$action_map = [
				TransferHdr::STATUS_DRAFT => ['Issue','issue'],
				TransferHdr::STATUS_DRAFT_RECEIVE => ['Receive','receive'],
			];
			echo Html::a('Delete', ['delete', 'id' => $model->id_transfer_hdr], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Are you sure to delete this item?'),
					'method' => 'post',
				],
			]);
			?>
	</p>

	<?php
	echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_transfer_hdr',
			'id_branch',
			'transfer_num',
			'id_warehouse_source',
			'id_warehouse_dest',
			'transfer_date',
			'id_status',
		],
	]);

	echo \yii\grid\GridView::widget([
		'dataProvider' => new \yii\data\ActiveDataProvider([
			'query' => $model->getTransferDtls(),
				]),
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id_product',
			'transfer_qty_send',
		]
	]);
	?>

</div>
