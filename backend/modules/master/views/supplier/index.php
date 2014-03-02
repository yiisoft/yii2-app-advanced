<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\master\models\SupplierSearch $searchModel
 */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= microtime(true); ?>
	<p>
		<?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?php yii\widgets\Pjax::begin([
		'enablePushState'=>false,
	]) ?>
	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_supplier',
			'cd_supplier',
			'nm_supplier',
			'create_date',
			'create_by',
			// 'update_date',
			// 'update_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php yii\widgets\Pjax::end() ?>
</div>
