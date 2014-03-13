<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\SalesHdr $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="sales-hdr-form">
	<?= date('d-m-Y H:i:s') ?>
	<?php $form = ActiveForm::begin(['options'=>['id'=>'pos-form']]); ?>
	<?php
	echo $this->render('_detail', ['model' => $model, 'detailProvider' => $detailProvider]);
	?>
	<div class="form-group">
		<?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJsFile(Url::toRoute(['js']),[\yii\web\YiiAsset::className()]);
$js = $this->render('_script');
$this->registerJs($js);
?>