<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\inventory\models\TransferHdr;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\inventory\models\TransferHdrSearch $searchModel
 */
$this->title = 'Inventory Transfer';
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
			'nmStatus',
			[
				'class' => 'yii\grid\ActionColumn',
				'buttons' => [
					'update' => function($url, $model) {
						if ($model->id_status <= 2) {
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
										'title' => Yii::t('yii', 'Update'),
							]);
						}
					},
					'delete' => function($url, $model) {
						if ($model->id_status <= 2) {
							return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
										'title' => Yii::t('yii', 'Delete'),
										'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
										'data-method' => 'post',
							]);
						}
					},
				]],
		],
	]);
	?>
	<?php yii\widgets\Pjax::end(); ?>

</div>
