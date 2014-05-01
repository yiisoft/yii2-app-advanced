<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\CashDrawer $model
 */
$this->title = 'Open Drawer';
$this->params['breadcrumbs'][] = ['label' => 'Cash Drawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-drawer-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?=
	$this->render('_form', [
		'model' => $model,
		'action'=>'open'
	])
	?>

</div>

<?php
if (isset($drawer)) {
	$s = json_encode($drawer);
	$js = "localStorage.setItem('drawer','$s');";
	$this->registerJs($js);
}