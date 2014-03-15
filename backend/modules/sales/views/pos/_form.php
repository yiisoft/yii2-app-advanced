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
	<?php $form = ActiveForm::begin(['options'=>['id'=>'pos-form']]); ?>
	<?= $this->render('_detail2', ['model' => $model, 'detailProvider' => $detailProvider]); ?>
	<div class="form-group">
		<?php echo Html::a('Save','',['class'=>'btn btn-primary','data-method'=>'pos']);?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJsFile(Url::toRoute(['js']),[\yii\web\YiiAsset::className()]);
$this->render('_script');