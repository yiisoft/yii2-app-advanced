<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var biz\models\OrgnSearch $searchModel
 */

$this->title = 'Orgns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orgn-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="pull-right">
        <?= Html::a('', ['create'], ['class' => 'btn btn-link glyphicon glyphicon-plus', 'title' => 'Create New', 'style' => 'width:100%;']) ?>
    </div>
    
	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        //'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			//'id_orgn',
			'cd_orgn',
			'nm_orgn',
			'create_date',
			'create_by',
			// 'update_date',
			// 'update_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
