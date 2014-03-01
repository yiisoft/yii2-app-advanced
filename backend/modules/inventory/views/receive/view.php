<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

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
		<?= Html::a('Update', ['update', 'id' => $model->id_transfer_hdr], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Receive', ['receive', 'id' => $model->id_transfer_hdr], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure to receive this item?'),
				'method' => 'post',
			],
		]); ?>
	</p>

	
	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'idBranch.nm_branch',
			'transfer_num',
			['name'=>'idWarehouseSource.nm_whse','label'=>'Gudang Asal'],
			['name'=>'idWarehouseDest.nm_whse','label'=>'Gudang Tujuan'],
			'transfer_date',
			'id_status',
		],
	]); ?>
	<?php 
 echo GridView::widget([
	 'dataProvider'=>new ActiveDataProvider([
		 'sort'=>false,
		 'pagination'=>false,
		 'query'=>$model->getTransferDtls()
	 ]),
	 'columns'=>[
		 'idProduct.nm_product',
		 'transfer_qty_send',
		 'transfer_qty_receive',
		 ['label'=>'Selisih',
			'value'=>function($model){
				return $model->transfer_qty_receive - $model->transfer_qty_send;
			}],
		 'idUom.nm_uom',
		 
	 ]
 ]);
	?>
</div>
