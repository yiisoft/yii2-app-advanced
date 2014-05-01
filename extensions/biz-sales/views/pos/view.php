<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\SalesHdr $model
 */

$this->title = $model->id_sales_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Sales Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-hdr-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_sales_hdr], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id_sales_hdr], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure to delete this item?'),
				'method' => 'post',
			],
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_sales_hdr',
			'sales_num',
			'id_warehouse',
			'id_customer',
			'update_by',
			'update_date',
			'create_by',
			'create_date',
			'sales_date',
		],
	]); ?>

</div>
