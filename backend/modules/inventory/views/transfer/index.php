<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventory\models\TransferHdr;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\inventory\models\TransferHdrSearch $searchModel
 */
$this->title = 'Transfer Hdrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-hdr-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

	<p>
		<?= Html::a('Create Transfer Hdr', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php yii\widgets\Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]); ?>
	<?php
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'transfer_num',
			'idWarehouseSource.nm_whse:text:Gudang Asal',
			'idWarehouseDest.nm_whse:text:Gudang Tujuan',
			['label'=>'Status',
				'value'=>function($model){
					switch ($model->id_status) {
						case TransferHdr::STATUS_DRAFT:
							return 'Draft';
						case TransferHdr::STATUS_ISSUE:
							return 'Release';
						case TransferHdr::STATUS_DRAFT_RECEIVE:
							return 'Draft Receive';
						case TransferHdr::STATUS_CONFIRM:
							return 'Confirm';
						case TransferHdr::STATUS_CONFIRM_APPROVE:
							return 'Confirm Approve';

						default:
							break;
					}
				}],
			['class' => 'yii\grid\ActionColumn'],
		],
	]);
	?>
	<?php yii\widgets\Pjax::end(); ?>

</div>
