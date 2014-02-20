<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\purchase\models\PurchaseDtlSearch $searchModel
 */

$this->title = 'Purchase Dtls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-dtl-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Purchase Dtl', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_purchase_dtl',
			'id_purchase_hdr',
			'id_product',
			'id_supplier',
			'purch_price',
			// 'purch_qty',
			// 'id_uom',
			// 'update_date',
			// 'update_by',
			// 'create_by',
			// 'create_date',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
