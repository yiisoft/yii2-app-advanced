<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$this->params['meta_description'] = 'Learn more about our Yii2 application and the team behind it.';
$this->params['meta_keywords'] = 'yii, yii2, about, php, framework';
?>
<div class="site-about d-flex align-items-center justify-content-center text-center">
    <div class="site-about-content mx-auto">
        <h1 class="display-6 fw-semibold mb-3"><?= Html::encode($this->title) ?></h1>

        <p class="text-body-secondary mb-4">
            This is the About page. You may modify the following file to customize its content:
            <?php if (YII_DEBUG): ?>
                <code class="d-block mt-2"><?= __FILE__ ?></code>
            <?php endif; ?>
        </p>

        <?= Html::a(
            'Go to Homepage',
            Yii::$app->homeUrl,
            [
                'class' => 'btn btn-outline-primary btn-lg',
            ],
        ) ?>
    </div>
</div>
