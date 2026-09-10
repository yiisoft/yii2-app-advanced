<?php

use common\models\User;
use MSpirkov\Yii2\Rector\Rules\AddPropertyTagsRector;
use MSpirkov\Yii2\Rector\Rules\RemoveRedundantPropertyTagsRector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/backend',
        __DIR__ . '/common',
        __DIR__ . '/console',
        __DIR__ . '/frontend',
    ])
    ->withConfiguredRule(
        AddPropertyTagsRector::class,
        [
            'skippedClasses' => [
                User::class => ['id'],
            ],
        ]
    )
    ->withRules([
        RemoveRedundantPropertyTagsRector::class,
    ]);
