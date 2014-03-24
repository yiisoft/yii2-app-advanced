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
            <div class="panel-heading">                
                Payment 
            </div>
            <div class="panel-body" style="font-size: xx-large; text-align: right;">
                <span id="cashback" >Rp0.00</span>
            </div>
            <table class="table table-striped" style="margin-bottom: 0px;">
                <tbody>
                    <tr>
                        <td>
                            Type:
                        </td>
                        <td>
                            <input type="text" width="100%">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Value:
                        </td>
                        <td>
                            <input type="text" width="100%">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panel  panel-info">
            <div class="panel-heading">
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
            <table class="table table-striped" style="margin-bottom: 0px;">
                <tbody>
                    <tr>
                        <td width="100px;">
                            No.Kasir:
                        </td>
                        <td>
                            <span id="kasir">1</span><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nama Kasir:
                        </td>
                        <td>
                            <span id="nmkasir">1</span><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            date-time:
                        </td>
                        <td>
                            <span id="kasir">now()</span>
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
