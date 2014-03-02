<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Branch $model
 */

$this->title = 'Update Branch: ' . $model->id_branch;
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_branch, 'url' => ['view', 'id' => $model->id_branch]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="branch-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
