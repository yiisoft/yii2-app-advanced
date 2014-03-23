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
                    <div><a href="#" class="session"></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="#" class="del">&minus;</a></div>
                </div>
                <div id="list-session">
                </div>
            </div>
        </div>
        <div class="panel panel-default">            
            <div class="panel-heading" style="font-weight: bold;">
                Payment
            </div>
            <div class="panel-body">
                CashBack :<h3><span id="cashback">Rp0</span></h32>
            </div>
            <table class="table table-striped" style="margin-bottom: 0px;">
                <tbody>
                    <tr>
                        <td>
                            Type :
                        </td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Value :
                        </td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php echo Html::a('Save', '', ['class' => 'btn btn-primary', 'data-method' => 'pos']); ?>
        <a id="new-session" class="btn btn-success" href="#">New Session</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->render('_script');
