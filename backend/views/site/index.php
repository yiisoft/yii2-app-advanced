<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Dashboard';
$username = Yii::$app->user->identity?->username;
?>
<div class="site-index">
    <!-- Welcome banner -->
    <div class="dashboard-banner text-white rounded-4 p-4 p-lg-5 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-2">Welcome back, <?= Html::encode($username) ?></h1>
                <p class="opacity-75 mb-0">
                    This is your administration panel. Manage your application from here.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <?= Html::img(
                    Yii::getAlias('@web/images/yii3_full_white_for_dark.svg'),
                    [
                        'alt' => 'Yii Framework', 'height' => 48,
                    ],
                ) ?>
            </div>
        </div>
    </div>
</div>
