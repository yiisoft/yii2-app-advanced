<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\ProductStock $model
 */

$this->title = $model->id_stock;
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_stock], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id_stock], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_stock',
			'id_warehouse',
			'opening_date',
			'id_product',
			'id_uom',
			'qty_stock',
			'status_closing',
			'create_date',
			'create_by',
			'update_date',
			'update_by',
		],
	]) ?>

</div>
