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
        <div class="panel panel-default">
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
                No.Kasir:<span id="kasir">1</span><br>
                Nama Kasir:<br>
                date-time:<span id="kasir">now()</span><br>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body label-info">
                <h3 style="margin-bottom: 0px;margin-top: 2px;">
					CashBack:<div id="cashback" style="text-align: right;">Rp 0.00</div>
				</h3>
            </div>
            <table class="table table-striped" style="margin-bottom: 0px;">
                <tbody>
                    <tr>
                        <td>
                            Payment Type :
                        </td>
                        <td>
                            <?php echo Html::dropDownList(false, '', [
								1=>'Cash',
								2=>'Bank'
							], ['id'=>'payment-type']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Value :
                        </td>
                        <td>
                            <?php echo Html::textInput(false, '', [
								'id'=>'payment-value',
								'size'=>10,]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?= Html::a('Save', '', ['class' => 'btn btn-primary', 'id' => 'btn-save']); ?>
		<?= Html::a('New Session', '', ['class' => 'btn btn-success', 'id' => 'new-session']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->render('_script');
