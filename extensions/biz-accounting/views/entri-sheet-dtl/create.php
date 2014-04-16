<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\accounting\models\EntriSheetDtl $model
 */

$this->title = 'Create Entri Sheet Dtl';
$this->params['breadcrumbs'][] = ['label' => 'Entri Sheet Dtls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entri-sheet-dtl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
