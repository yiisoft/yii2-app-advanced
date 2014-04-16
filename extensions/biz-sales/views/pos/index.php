<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\sales\models\SalesHdrSearch $searchModel
 */

$this->title = 'Sales Hdrs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-hdr-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Sales Hdr', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_sales_hdr',
			'sales_num',
			'id_warehouse',
			'id_customer',
			'update_by',
			// 'update_date',
			// 'create_by',
			// 'create_date',
			// 'sales_date',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
