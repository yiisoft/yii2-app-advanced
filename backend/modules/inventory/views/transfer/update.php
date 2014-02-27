<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdr $model
 */

$this->title = 'Update Transfer Hdr: ' . $model->id_transfer_hdr;
$this->params['breadcrumbs'][] = ['label' => 'Transfer Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_transfer_hdr, 'url' => ['view', 'id' => $model->id_transfer_hdr]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transfer-hdr-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
		'detailProvider'=>$detailProvider,
	]); ?>

</div>
