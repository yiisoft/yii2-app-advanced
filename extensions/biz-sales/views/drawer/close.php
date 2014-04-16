<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\sales\models\CashDrawer $model
 */

$this->title = 'Close Drawer';
$this->params['breadcrumbs'][] = ['label' => 'Cash Drawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cash_drawer, 'url' => ['view', 'id' => $model->id_cash_drawer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-drawer-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'action'=>'close',
	]) ?>

</div>
<?php 
if($closed){
	$js = "localStorage.removeItem('drawer');";
	$this->registerJs($js);
}