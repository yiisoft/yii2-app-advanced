<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\master\models\Orgn $model
 */

$this->title = 'Update Orgn: ' . $model->id_orgn;
$this->params['breadcrumbs'][] = ['label' => 'Orgns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_orgn, 'url' => ['view', 'id' => $model->id_orgn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orgn-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
