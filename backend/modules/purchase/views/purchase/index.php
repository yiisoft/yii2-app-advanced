<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

	<?php yii\widgets\Pjax::begin(['formSelector'=>'form','enablePushState'=>false]); ?>
	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'id_purchase_hdr',
			'purchase_num',
			'idSupplier.nm_supplier',
			'idWarehouse.nm_whse',
			'purchase_date',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php yii\widgets\Pjax::end(); ?>
</div>
