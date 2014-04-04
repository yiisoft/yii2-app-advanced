<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\master\models\BranchSearch $searchModel
 */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="pull-right">
        <?= Html::a('', ['create'], ['class' => 'btn btn-default glyphicon glyphicon-plus', 'title' => 'Create New', 'style' => 'width:100%;']) ?>
    </div>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        'columns'=>[
			['class' => 'yii\grid\SerialColumn'],
            //'id_branch',
			'cd_branch',
			'nm_branch',
			['class'=>'yii\grid\ActionColumn']
		]
	]); ?>

</div>
