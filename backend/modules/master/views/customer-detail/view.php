<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\CustomerDetail $model
 */

$this->title = $model->id_customer;
$this->params['breadcrumbs'][] = ['label' => 'Customer Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-detail-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_customer], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id_customer], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_customer',
			'id_distric',
			'addr1',
			'addr2',
			'latitude',
			'longtitude',
			'id_kab',
			'id_kec',
			'id_kel',
			'file_name',
			'file_type',
			'create_date',
			'create_by',
			'update_date',
			'update_by',
			'file_size',
		],
	]); ?>

</div>
