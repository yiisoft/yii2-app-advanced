<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
$this->params['meta_description'] = 'A high-performance PHP framework best for developing web applications. Fast, secure, and professional.';
$this->params['meta_keywords'] = 'yii, yii2, php, framework, web application, high-performance';
?>
<div class="site-index">

    <!-- Hero banner with Yii gradient -->
    <div class="hero-banner text-white rounded-4 p-5 mb-4 position-relative overflow-hidden">
        <?= Html::img(Yii::getAlias('@web/images/yii3_full_white_for_dark.svg'), [
            'alt' => '',
            'class' => 'd-none d-lg-block position-absolute hero-logo',
        ]) ?>
        <div class="position-relative">
            <h1 class="display-5 fw-bold mb-3">Build with Yii Framework</h1>
            <p class="lead opacity-75 mb-4 hero-lead">
                A high-performance PHP framework best for developing web applications.
                Fast, secure, and professional.
            </p>
            <div class="d-flex gap-2 flex-wrap">
                <?= Html::a(
                    'Get Started',
                    'https://www.yiiframework.com/doc/guide/2.0/en/start-installation',
                    [
                        'class' => 'btn btn-light btn-lg fw-semibold px-4',
                        'rel' => 'noopener',
                        'target' => '_blank',
                    ],
                ) ?>
                <?= Html::a(
                    'API Reference',
                    'https://www.yiiframework.com/doc/api/2.0',
                    [
                        'class' => 'btn btn-outline-light btn-lg px-4',
                        'rel' => 'noopener',
                        'target' => '_blank',
                    ],
                ) ?>
            </div>
        </div>
    </div>

    <!-- Extensions grid -->
    <div class="row g-3">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#128270;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-debug</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Debug toolbar and debugger for Yii2. Inspect logs, database queries,
                        request data, and application performance in real time.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://www.yiiframework.com/extension/yiisoft/yii2-debug',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ],
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#9881;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-gii</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Automatic code generator for models, controllers, CRUD, forms, and modules.
                        Boost your productivity with scaffolding.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://www.yiiframework.com/extension/yiisoft/yii2-gii',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ],
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#128203;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-queue</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Asynchronous job queue with support for DB, Redis, AMQP, Beanstalk,
                        and SQS drivers. Run background tasks with ease.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://www.yiiframework.com/extension/yiisoft/yii2-queue',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#9889;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-redis</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Redis integration providing cache, session, and ActiveRecord support.
                        Leverage in-memory storage for blazing-fast data access.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://www.yiiframework.com/extension/yiisoft/yii2-redis',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#128269;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-elasticsearch</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Elasticsearch integration with ActiveRecord and query builder.
                        Add powerful full-text search capabilities to your application.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://www.yiiframework.com/extension/yiisoft/yii2-elasticsearch',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-3 extension-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="extension-icon">&#9993;</span>
                        <h3 class="h6 fw-bold mb-0 ms-2">yii2-symfonymailer</h3>
                    </div>
                    <p class="text-body-secondary small mb-0">
                        Email sending integration powered by Symfony Mailer.
                        Compose and deliver rich HTML emails with attachments and templates.
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <?= Html::a(
                        'Learn more &raquo;',
                        'https://github.com/yiisoft/yii2-symfonymailer',
                        [
                            'class' => 'btn btn-sm btn-outline-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

</div>
