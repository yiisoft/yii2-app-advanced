<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\purchase\models\PurchaseHdr $model
 */
$this->title = 'Create Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Purchase', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-hdr-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php
	echo $this->render('_form', [
		'model' => $model,
		'details' => $details
	]);
	?>

</div>
