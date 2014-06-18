<?php
use yii\helpers\Html;

/* @var $form yii\widgets\ActiveForm */
/* @var $details biz\models\EntriSheetDtl[] */
/* @var $this yii\web\View */
?>
<table style="width: 98%">
    <thead>
        <tr>
            <th style="width: 40%">Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $name=>$detail): ?>
        <tr>
            <td><?= $name ?></td>
            <td><?= $form->field($detail, "[$name]debit", ['template'=>"{input}\n{error}"]) ?></td>
            <td><?= $form->field($detail, "[$name]kredit", ['template'=>"{input}\n{error}"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>