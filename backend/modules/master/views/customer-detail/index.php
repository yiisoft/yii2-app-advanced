<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\master\models\CustomerDetailSearch $searchModel
 */

$this->title = 'Customer Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-detail-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Customer Detail', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_customer',
			'id_distric',
			'addr1',
			'addr2',
			'latitude',
			// 'longtitude',
			// 'id_kab',
			// 'id_kec',
			// 'id_kel',
			// 'file_name',
			// 'file_type',
			// 'create_date',
			// 'create_by',
			// 'update_date',
			// 'update_by',
			// 'file_size',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
