<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var biz\models\Orgn $model
 */

$this->title = $model->id_orgn;
$this->params['breadcrumbs'][] = ['label' => 'Orgns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orgn-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_orgn], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id_orgn], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_orgn',
			'cd_orgn',
			'nm_orgn',
			'create_date',
			'create_by',
			'update_date',
			'update_by',
		],
	]); ?>

</div>
