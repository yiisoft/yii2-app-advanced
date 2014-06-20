<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use biz\tools\Helper;
use biz\models\Cashdrawer;

$model = new Cashdrawer([
    'id_branch' => Yii::$app->clientIdBranch,
    'cashier_no' => Yii::$app->clientCashierNo,
    ]);
?>
<?php
Modal::begin([
    'id' => 'dlg-drawer',
    'closeButton' => null,
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => false,
    ]
]);
?>
<div class="cash-drawer-form">
    <?= $form->field($model, 'id_branch')->dropDownList(Helper::getBranchList()) ?>
    <?= $form->field($model, 'cashier_no')->dropDownList([1 => 1, 2 => 2, 3 => 3, 4 => 4]) ?>
    <?= $form->field($model, 'init_cash') ?>
    <div class="form-group">
        <?= Html::a('Open New', '', ['class' => 'btn btn-success', 'id' => 'cashdrawer-opennew']); ?>
    </div>
</div>
<?php Modal::end(); ?>

<?php
Modal::begin([
    'id' => 'dlg-confirm-save',
    'closeButton' => null,
    'size' => Modal::SIZE_SMALL,
    'clientOptions' => [
        'backdrop' => 'static',
//        'keyboard' => false,
    ]
]);
?>
<div class="modal-body">
    <p>Save transaction.</p>
    <p>Print?</p>
</div>
<div class="modal-footer">
    <a href="#" id="btn-confirm-yes" class="btn danger">Yes</a>
    <a href="#" id="btn-confirm-no" class="btn danger">No</a>
    <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
</div>
<?php Modal::end(); ?>