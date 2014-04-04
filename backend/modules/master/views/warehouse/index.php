<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\master\models\WarehouseSearch $searchModel
 */

$this->title = 'Warehouses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="pull-right">
        <?= Html::a('', ['create'], ['class' => 'btn btn-default glyphicon glyphicon-plus', 'title' => 'Create New', 'style' => 'width:100%;']) ?>
    </div>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id_warehouse',
			'cd_whse',
			'nm_whse',
			'create_date',
			'create_by',
			// 'update_date',
			// 'update_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
