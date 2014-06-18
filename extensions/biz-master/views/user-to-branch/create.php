<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var biz\models\User2Branch $model
 */

$this->title = 'Create User2 Branch';
$this->params['breadcrumbs'][] = ['label' => 'User2 Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user2-branch-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
