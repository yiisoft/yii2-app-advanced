<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\master\models\Category;
use backend\modules\master\models\ProductGroups;

/**
 * @var yii\web\View $this
 * @var backend\modules\master\models\Product $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<?php $form = ActiveForm::begin(); ?>
<div class=" product col-lg-6" style="padding-left: 0px;">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Product
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'cd_product')->textInput(['maxlength' => 13, 'style' => 'width:160px;']) ?>

            <?= $form->field($model, 'nm_product')->textInput(['maxlength' => 64]) ?>

            <?= $form->field($model, 'id_category')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id_category', 'nm_category'), ['style' => 'width:200px;']); ?>

            <?= $form->field($model, 'id_group')->dropDownList(ArrayHelper::map(ProductGroups::find()->all(), 'id_group', 'nm_group'), ['style' => 'width:200px;']); ?>

        </div>   

    </div>

</div>

<style>
    .tab-content {
        border: 1px #e0e0e0 solid;
        border-top: none;
        padding: 20px;
    }
</style>

<div class="col-lg-6">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Uoms</a></li>
        <li><a href="#home" data-toggle="tab">Cogs</a></li>
        <li><a href="#profile" data-toggle="tab">Price</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home"></div>
        <div class="tab-pane" id="profile"></div>
        <div class="tab-pane" id="profile"></div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>


<?php
ActiveForm::end();
