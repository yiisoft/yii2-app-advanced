<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Transfer Hdr', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_transfer_hdr',
			'id_branch',
			'transfer_num',
			'id_warehouse_source',
			'id_warehouse_dest',
			// 'transfer_date',
			// 'id_status',
			// 'update_date',
			// 'update_by',
			// 'create_by',
			// 'create_date',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
