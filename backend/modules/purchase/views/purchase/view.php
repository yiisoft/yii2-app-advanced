<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\purchase\models\PurchaseHdr;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 */
$this->title = $model->id_purchase_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?php
		if ($model->id_status == PurchaseHdr::STATUS_DRAFT) {
			echo Html::a('Update', ['update', 'id' => $model->id_purchase_hdr], ['class' => 'btn btn-primary']) . ' ';
			echo Html::a('Delete', ['delete', 'id' => $model->id_purchase_hdr], [
				'class' => 'btn btn-danger',
				'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
				'data-method' => 'post',
			]) . ' ';
			echo Html::a('Release', ['release', 'id' => $model->id_purchase_hdr], [
				'class' => 'btn btn-primary',
				'data-confirm' => Yii::t('app', 'Are you sure to release this item?'),
				'data-method' => 'post',
			]) . ' ';
		} elseif (true) {
			echo Html::a('Receive', ['receive', 'id' => $model->id_purchase_hdr], [
				'class' => 'btn btn-primary',
				'data-confirm' => Yii::t('app', 'Are you sure to receive this item?'),
				'data-method' => 'post',
			]);
		}
		?>
	</p>

	<?php
	echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_purchase_hdr',
			'purchase_num',
			'id_supplier',
			'id_warehouse',
			'purchase_date',
			'id_status',
		],
	]);

	echo yii\grid\GridView::widget([
		'dataProvider' => new \yii\data\ActiveDataProvider([
			'query' => $model->getPurchaseDtls()
				]),
	]);
	?>

</div>
