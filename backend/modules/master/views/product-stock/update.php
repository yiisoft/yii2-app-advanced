<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductStock $model
 */

$this->title = 'Update Product Stock: ' . $model->id_stock;
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_stock, 'url' => ['view', 'id' => $model->id_stock]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-stock-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
