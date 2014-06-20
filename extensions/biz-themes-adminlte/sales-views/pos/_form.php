<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\sales\components\PosAsset;
use yii\helpers\Url;
use biz\tools\BizDataAsset;

/**
 * @var yii\web\View $this
 * @var biz\models\SalesHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-hdr-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'pos-form']]); ?>
    <div class="col-lg-4">
        <div class="box box-danger">
            <div class="box-header" style="font-weight: bold;">                
                <h3 class="box-title">Active Session</h3>
                <div class="pull-right box-tools">
                    <span data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                        <i class="fa fa-minus-square-o"></i>
                    </span>
                </div>
            </div>
            <div class="box-body">
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
                <?=
                Html::a('<span class="glyphicon glyphicon-off"></span>', ['close-drawer'], [
                    'target' => '_blank', 'class' => 'pull-right'])
                ?>
                <?= Html::hiddenInput('', '', ['id' => 'id-drawer']) ?>
                <div>Cabang: &nbsp;<?= Html::tag('span', '', ['id' => 'nm-cabang']) ?></div>
                <div>No. Kasir: &nbsp;  <?= Html::tag('span', '', ['id' => 'no-kasir']) ?></div>
                <div>Nama Kasir: &nbsp;<?= Html::tag('span', '', ['id' => 'nama-kasir']) ?></span></div>
                <div>Time: &nbsp;<?= Html::tag('span', '', ['id' => 'open-time']) ?></span></div>
                <br>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Payment</h3>
                <div class="pull-right box-tools">
                    <span data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                        <i class="fa fa-minus-square-o"></i>
                    </span>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="payment-method">Payment Method :</label>
                    <?php
                    echo Html::dropDownList(false, '', $payment_methods, [
                        'id' => 'payment-method', 'class' => 'form-control']);
                    ?>
                </div>
                <div class="form-group">
                    <label for="payment-value">Amount :</label>
                    <?php
                    echo Html::textInput(false, '', [
                        'id' => 'payment-value', 'class' => 'form-control']);
                    ?>
                </div>
            </div>
            <div class="panel-footer"> 
                <h3>
                    CashBack :<span id="cashback" style="text-align: right;">Rp 0.00</span>
                </h3>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <?= $this->render('_detail'); ?>        
        <div>                
            <?php Html::a('Save', '', ['class' => 'btn btn-primary', 'id' => 'btn-save']); ?>&nbsp;
            <?php Html::a('New Session', '', ['class' => 'btn btn-success', 'id' => 'new-session']); ?>
        </div>
    </div>
    <?= $this->render('_dialog', ['form' => $form]); ?>
    <?php ActiveForm::end(); ?>
</div>
<?php
PosAsset::register($this);
BizDataAsset::register($this, [
    'master' => [],
    'config' => [
        'pushUrl' => Url::toRoute(['save-pos']),
        'newDrawerUrl' => Url::toRoute(['open-new-drawer']),
        'checkDrawerUrl' => Url::toRoute(['check-drawer']),
        'pullMasterUrl' => Url::toRoute(['masters']),
        'delay' => 1000,
        'pushInterval' => 10000,
    ]
]);
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItemPos;';
$this->registerJs($js_ready);
