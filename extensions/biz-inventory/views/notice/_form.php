<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use biz\models\TransferNotice;

/**
 * @var yii\web\View $this
 * @var biz\models\TransferNotice $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $form = ActiveForm::begin([
    'fieldConfig'=>[
        'template'=>"{input}"
    ]
]) ?>
<?php 
$renderField = function ($model) use($form)
{
    return $form->field($model, "[{$model->id_product}]qty_approve")->textInput(['style'=>'width:80px;']);
}
?>
<div class="purchase-hdr-view col-lg-9">
    <?php
    echo GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => '{items}{pager}',
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $details,
            'sort' => false,
            'pagination' => false,
            ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idProduct.nm_product',
            'transferDtl.transfer_qty_send:text:Qty Send',
            'transferDtl.transfer_qty_receive:text:Qty Receive',
            'qty_selisih',
            [
                'label' => 'Qty Approve',
                'format' => 'raw',
                'value' => $renderField],
            'idUom.nm_uom',
        ]
    ]);
    ?>
</div>
<div class="col-lg-3" style="padding-left: 0px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Notice Header
        </div>
        <?php
        echo DetailView::widget([
            'options' => ['class' => 'table table-striped detail-view', 'style' => 'padding:0px;'],
            'model' => $model,
            'attributes' => [
                'idTransfer.transfer_num',
                'idTransfer.idWarehouseSource.nm_whse',
                'idTransfer.idWarehouseDest.nm_whse',
                'noticeDate',
            ],
        ]);
        ?>
    </div>
    <?php
    if ($model->status == TransferNotice::STATUS_CREATE) {
        echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    }
    ?>
</div>
<?php
ActiveForm::end();
