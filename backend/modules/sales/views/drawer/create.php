<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\modules\sales\models\Cashdrawer $model
 */

$this->title = 'Create Cashdrawer';
$this->params['breadcrumbs'][] = ['label' => 'Cashdrawers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashdrawer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
