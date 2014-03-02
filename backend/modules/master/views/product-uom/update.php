<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\ProductUom $model
 */

$this->title = 'Update Product Uom: ' . $model->id_puom;
$this->params['breadcrumbs'][] = ['label' => 'Product Uoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_puom, 'url' => ['view', 'id' => $model->id_puom]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-uom-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
