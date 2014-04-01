<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Product $model
 */
$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view col-lg-6" style="padding-left: 0px;">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Product
        </div>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_product',
                'cd_product',
                'nm_product',
                'id_category',
                'id_group',
                'create_date',
                'create_by',
                'update_date',
                'update_by',
            ],
        ])
        ?>
    </div>
</div>
<div class="col-lg-6">
    <style>
        .tab-content {
            border: 1px #e0e0e0 solid;
            border-top: none;
            padding: 20px;
        }
    </style>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#uoms" data-toggle="tab">Uoms</a></li>
        <li><a href="#cogs" data-toggle="tab">Cogs</a></li>
        <li><a href="#price" data-toggle="tab">Price</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="uoms">
            <?php
            if ($model->isNewRecord):
                echo $form->field($model, 'productUoms[id_uom]')->dropDownList(ArrayHelper::map(Uom::find()->all(), 'id_uom', 'nm_uom'), ['style' => 'width:200px;']);
                echo $form->field($model, 'productUoms[isi]')->textInput(['style' => 'width:120px;']);
            else:
                $dPro = new ActiveDataProvider([
                    'query' => $model->getProductUoms(),
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]);

                echo GridView::widget([
                    'dataProvider' => $dPro,
                    'tableOptions' => ['class' => 'table table-striped'],
                    'layout' => '{items}',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'idUom.nm_uom',
                        'idUom.cd_uom',
                        'isi'
                    ],
                ]);

            endif;
            ?>
        </div>
        <div class="tab-pane" id="profile"></div>
        <div class="tab-pane" id="profile"></div>
    </div>

    <br>
    <?= Html::a('Update', ['update', 'id' => $model->id_product], ['class' => 'btn btn-primary']) ?>
    <?=
    Html::a('Delete', ['delete', 'id' => $model->id_product], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ])
    ?>
</div>

