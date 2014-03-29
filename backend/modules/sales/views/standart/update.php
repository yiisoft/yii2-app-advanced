<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 */

$this->title = 'Update Sales: ' . $model->sales_num;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sales_num, 'url' => ['view', 'id' => $model->id_sales]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
		'details'=>$details,
	]); ?>

</div>
