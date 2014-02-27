<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\PurchaseHdr $model
 */

$this->title = 'Update Purchase Hdr: ' . $model->id_purchase_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_purchase_hdr, 'url' => ['view', 'id' => $model->id_purchase_hdr]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-hdr-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
		'detailProvider'=>$detailProvider,
	]); ?>

</div>
