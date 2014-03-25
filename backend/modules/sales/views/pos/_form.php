<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\SalesHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-hdr-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'pos-form']]); ?>
    <div class="col-lg-9" style="padding-left: 0px;">
        <?= $this->render('_detail'); ?>
    </div>
    <div class="col-lg-3" style="padding-right: 0px;">
        <div class="panel panel-primary">
            <div class="panel-heading" style="font-weight: bold;">
                Active Session
            </div>
            <div class="panel-body">
                <div id="list-template" style="display: none;">
                    <div>
                        <a href="#" class="session"></a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="del"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </div>
                <div id="list-session">
                </div>
            </div>
            <div class="panel-footer">
				<?php
				Html::a('<span class="glyphicon glyphicon-pencil"></span>', '', [
					'id'=>'edit-kasir',
					'style'=>'float: right;'
				]);
				echo Html::a('<span class="glyphicon glyphicon-pencil"></span>', '', [
					'id'=>'edit-kasir',
					'data-toggle'=>'modal','data-target'=>'#dlg-drawer',
					'style'=>'float: right;'
				]);
				?>
				<input type="hidden" id="id-drawer">
				<div>No. Kasir: &nbsp;<span id="no-kasir"></span></div>
				<div>Nama Kasir: &nbsp;<span id="nama-kasir"></span></div>
				<div>Time: &nbsp;<span id="current-time"></span></div>
                <br>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Payment
            </div>
            <div class="panel-body">
                <h3 style="margin-bottom: 0px;margin-top: 2px;">
                    <div id="cashback" style="text-align: right;">Rp 0.00</div>
                </h3>
            </div>
			<div class="panel-body" style="margin-right: 10px;">
				<div style="margin-bottom: 10px;">
					<?php echo Html::dropDownList(false, '', $payment_methods, [
						'id'=>'payment-method','style'=>'float:right;']); ?>
					Payment Method :
				</div>
				<div >
					<?php echo Html::textInput(false, '', [
								'id'=>'payment-value','size'=>10,'style'=>'float:right;']); ?>
					Value :
				</div>
			</div>
        </div>
<?= Html::a('Save', '', ['class' => 'btn btn-primary', 'id' => 'btn-save']); ?>
<?= Html::a('New Session', '', ['class' => 'btn btn-success', 'id' => 'new-session']); ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
<?php
echo $this->render('_dialog');
$this->render('_script');
