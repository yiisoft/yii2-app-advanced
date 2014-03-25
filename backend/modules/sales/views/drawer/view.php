<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\CashDrawer $model
 */

$this->title = $model->id_cash_drawer;
$this->params['breadcrumbs'][] = ['label' => 'Cash Drawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-drawer-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_cash_drawer], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id_cash_drawer], [
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
			'id_cash_drawer',
			'id_branch',
			'no_cashier',
			'initial_cash',
			'close_cash',
			'create_date',
			'id_status',
			'create_by',
			'update_date',
			'update_by',
		],
	]) ?>

</div>
