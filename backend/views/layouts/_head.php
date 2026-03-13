<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use backend\assets\AppAsset;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(
    ['charset' => Yii::$app->charset],
    'charset',
);
$this->registerMetaTag(
    [
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1',
    ],
);
if (!empty($this->params['meta_description'])) {
    $this->registerMetaTag(
        [
            'name' => 'description',
            'content' => $this->params['meta_description'],
        ],
    );
}
if (!empty($this->params['meta_keywords'])) {
    $this->registerMetaTag(
        [
            'name' => 'keywords',
            'content' => $this->params['meta_keywords'],
        ],
    );
}
$this->registerLinkTag(
    [
        'rel' => 'icon',
        'type' => 'image/x-icon',
        'href' => Yii::getAlias('@web/favicon.ico'),
    ],
);
