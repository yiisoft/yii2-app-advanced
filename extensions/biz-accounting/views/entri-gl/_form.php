<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use biz\models\GlDetail;

/* @var $model biz\models\GlHeader */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $details biz\models\GlDetails[] */
?>

<div class="gl-header-form">
    <?php
    $form = ActiveForm::begin();
    echo $form->errorSummary($model);
    
    ?>
    <div class="panel panel-primary col-lg-8 no-padding">
        <div class="panel-body">
            <div class="col-lg-5">
                <?= $form->field($model, 'glDate') ?>
                <?= $form->field($model, 'id_branch')->textInput() ?>
            </div>
            <div class="col-lg-7">
                <?= $form->field($model, 'type_reff')->textInput() ?>
                <?= $form->field($model, 'description')->textarea() ?>
            </div>
        </div>
        <table class ="table table-striped" id="tbl-gldetail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th><a class="fa fa-plus-square" href="#"></a></th>
                </tr>
                <?php

                /**
                 * 
                 * @param biz\models\GlDetail $model
                 * @param integer $index
                 * @return string
                 */
                function renderRow($model, $index)
                {
                    ob_start();
                    ob_implicit_flush(false);
                    ?>
                    <tr>
                        <?= Html::activeHiddenInput($model, "[$index]id_gl_detail") ?>
                        <td class="serial"><?= $index ?></td>
                        <td><?= Html::activeTextInput($model, "[$index]id_coa") ?></td>
                        <td><?= Html::activeTextInput($model, "[$index]debit") ?></td>
                        <td><?= Html::activeTextInput($model, "[$index]kredit") ?></td>
                        <td class="action"><a class="fa fa-minus-square-o" href="#"></a></td>
                    </tr>
                    <?php
                    return trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                }
                ?>
            </thead>
            <?php
            $rows = [];

            foreach ($details as $index => $detail) {
                $rows[] = renderRow($detail, $index);
            }
            echo Html::tag('tbody', implode("\n", $rows), ['data-template' => renderRow(new GlDetail(), '_index_')])
            ?>

        </table>

        <div class="panel-footer">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$a = \biz\accounting\components\EntryGlAsset::register($this);