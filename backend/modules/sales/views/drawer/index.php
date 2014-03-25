<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\sales\models\CashDrawerSearch $searchModel
 */

$this->title = 'Cash Drawers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-drawer-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Cash Drawer', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_cash_drawer',
			'id_branch',
			'no_cashier',
			'initial_cash',
			'close_cash',
			// 'create_date',
			// 'id_status',
			// 'create_by',
			// 'update_date',
			// 'update_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
