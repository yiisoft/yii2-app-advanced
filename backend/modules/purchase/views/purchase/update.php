<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 */

$this->title = 'Update Purchase: ' . $model->purchase_num;
$this->params['breadcrumbs'][] = ['label' => 'Purchase', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->purchase_num, 'url' => ['view', 'id' => $model->id_purchase]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-hdr-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
		'details'=>$details,
	]); ?>

</div>
