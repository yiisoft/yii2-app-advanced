<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\inventory\models\TransferHdr $model
 */

$this->title = 'Create Transfer Hdr';
$this->params['breadcrumbs'][] = ['label' => 'Transfer Hdrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-hdr-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
		'detailProvider' => $detailProvider
	]); ?>

</div>
