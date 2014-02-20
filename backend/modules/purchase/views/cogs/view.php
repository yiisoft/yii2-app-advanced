<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\Cogs $model
 */

$this->title = $model->id_cogs;
$this->params['breadcrumbs'][] = ['label' => 'Cogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cogs-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->id_cogs], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->id_cogs], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id_cogs',
			'id_branch',
			'id_product',
			'id_uom',
			'cogs',
			'update_date',
			'create_by',
			'create_date',
			'update_by',
		],
	]); ?>

</div>
