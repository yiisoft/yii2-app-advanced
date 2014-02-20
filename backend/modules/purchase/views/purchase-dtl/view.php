<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseDtl $model
 */

$this->title = $model->id_purchase_dtl;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Dtls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-dtl-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_purchase_dtl], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id_purchase_dtl], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_purchase_dtl',
			'id_purchase_hdr',
			'id_product',
			'id_supplier',
			'purch_price',
			'purch_qty',
			'id_uom',
			'update_date',
			'update_by',
			'create_by',
			'create_date',
		],
	]); ?>

</div>
