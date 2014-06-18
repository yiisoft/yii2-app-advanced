<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\sales\components\PosAsset;
use yii\helpers\Url;
use biz\tools\BizDataAsset;


/* @var yii\web\View $this */
/* @var biz\models\SalesHdr $model */
/* @var yii\widgets\ActiveForm $form */

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
                <?= Html::hiddenInput('', $cashDrawer->id_cashdrawer, ['id' => 'id-drawer']) ?>
                <?php $nm_cabang = $cashDrawer->idBranch ? $cashDrawer->idBranch->nm_branch : '' ?>
                <div>Cabang: &nbsp;<?= Html::tag('span', $nm_cabang, ['id' => 'nm-cabang']) ?></div>
                <div>No. Kasir: &nbsp;<?= Html::tag('span', $cashDrawer->cashier_no, ['id' => 'no-kasir']) ?></div>
                <div>Nama Kasir: &nbsp;<?= Html::tag('span', Yii::$app->user->identity->username, ['id' => 'nama-kasir']) ?></span></div>
                <div>Time: &nbsp;<?= Html::tag('span', $cashDrawer->open_time, ['id' => 'open-time']) ?></span></div>
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
                    <?php
                    echo Html::dropDownList(false, '', $payment_methods, [
                        'id' => 'payment-method', 'style' => 'float:right;']);
                    ?>
                    Payment Method :
                </div>
                <div >
                    <?php
                    echo Html::textInput(false, '', [
                        'id' => 'payment-value', 'size' => 10, 'style' => 'float:right;']);
                    ?>
                    Value :
                </div>
            </div>
        </div>
        <?php Html::a('Save', '', ['class' => 'btn btn-primary', 'id' => 'btn-save']); ?>&nbsp;
        <?php Html::a('New Session', '', ['class' => 'btn btn-success', 'id' => 'new-session']); ?>
    </div>

    <?= $this->render('_dialog', ['form' => $form, 'model' => $cashDrawer]); ?>
    <?php ActiveForm::end(); ?>
</div>
<?php
PosAsset::register($this);
BizDataAsset::register($this, [
    'master' => $masters,
    'config' => [
        'pushUrl' => Url::toRoute(['save-pos']),
        'newDrawerUrl' => Url::toRoute(['open-new-drawer']),
        'delay' => 1000,
    ]
]);
$js_ready = '$("#product").data("ui-autocomplete")._renderItem = yii.global.renderItemPos;';
$this->registerJs($js_ready);
