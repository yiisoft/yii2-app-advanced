<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var backend\modules\accounting\models\EntriSheetDtl $model
 */

$this->title = $model->id_esheet;
$this->params['breadcrumbs'][] = ['label' => 'Entri Sheet Dtls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entri-sheet-dtl-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_esheet' => $model->id_esheet, 'id_coa' => $model->id_coa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_esheet' => $model->id_esheet, 'id_coa' => $model->id_coa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_esheet',
            'id_coa',
            'dk',
        ],
    ]) ?>

</div>
