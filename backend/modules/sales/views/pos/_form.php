<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\SalesHdr $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-hdr-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'pos-form']]); ?>
    <?= $this->render('_detail'); ?>
    <div class="col-lg-3">
        <?php echo Html::a('Save', '', ['class' => 'btn btn-primary', 'data-method' => 'pos']); ?>
        <a id="new-session" class="btn btn-success" href="#">New Session</a>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Modal::begin([
    'header' => 'Test...',
    'clientOptions' => [
        'backdrop' => 'static',
    ]
]);
?>

<?php Modal::end(); ?>

<?php
$this->render('_script');
