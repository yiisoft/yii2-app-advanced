<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\master\models\ProductStockSearch $searchModel
 */

$this->title = 'Product Stocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Product Stock', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'idWarehouse.nm_whse',
			'opening_date',
			'idProduct.nm_product',
			'qty_stock',
			'idUom.nm_uom',
			// 'qty_stock',
			// 'status_closing',
			// 'create_date',
			// 'create_by',
			// 'update_date',
			// 'update_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
