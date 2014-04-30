<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\EntriSheet $model
 */

$this->title = 'Create Entri Sheet';
$this->params['breadcrumbs'][] = ['label' => 'Entri Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entri-sheet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
