<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\sales\models\SalesHdr;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\SalesHdr $model
 */
$this->title = $model->sales_num;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?php
		if ($model->status == SalesHdr::STATUS_DRAFT) {
			echo Html::a('Update', ['update', 'id' => $model->id_sales], ['class' => 'btn btn-primary']) . ' ';
			echo Html::a('Delete', ['delete', 'id' => $model->id_sales], [
				'class' => 'btn btn-danger',
				'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
				'data-method' => 'post',
			]) . ' ';
			echo Html::a('Receive', ['receive', 'id' => $model->id_sales], [
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
			'sales_num',
			'idCustomer.nm_cust',
			'idBranch.nm_branch',
			'sales_date',
			'nmStatus',
		],
	]);

	echo yii\grid\GridView::widget([
		'dataProvider' => new \yii\data\ActiveDataProvider([
			'query' => $model->getSalesDtls(),
			'sort'=>false,
			'pagination'=>false,
				]),
		'columns'=>[
			['class'=>'yii\grid\SerialColumn'],
			'idProduct.nm_product',
			'sales_qty',
			'sales_price',
			'idUom.nm_uom',
		]
	]);
	?>

</div>
