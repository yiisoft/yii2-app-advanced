<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseDtl $model
 */

$this->title = 'Update Purchase Dtl: ' . $model->id_purchase_dtl;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Dtls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_purchase_dtl, 'url' => ['view', 'id' => $model->id_purchase_dtl]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-dtl-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
