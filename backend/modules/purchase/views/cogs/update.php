<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\Cogs $model
 */

$this->title = 'Update Cogs: ' . $model->id_cogs;
$this->params['breadcrumbs'][] = ['label' => 'Cogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cogs, 'url' => ['view', 'id' => $model->id_cogs]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cogs-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
