<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\SalesHdr $model
 */

$this->title = 'Update Sales Hdr: ' . $model->id_sales_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Sales Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sales_hdr, 'url' => ['view', 'id' => $model->id_sales_hdr]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-hdr-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
