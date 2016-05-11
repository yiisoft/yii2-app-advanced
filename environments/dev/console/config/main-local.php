<?php

return [
    'bootstrap' => [
        /* @see \yii\base\Application::$bootstrap */
        'gii',
    ],
    'controllerMap' => [
        /* @see \yii\base\Module::$controllerMap */
        'fixture' => [
            // to get more info by 'fixture' execute in console "php yii help fixture"          
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'console\fixtures\common',
            /* @see \yii\console\controllers\FixtureController::$globalFixtures */
            'globalFixtures' => [
                'yii\test\InitDb',
            ],
        ],
        'fixture-backend' => [ // alias command for backend only ("php yii help fixture-backend")
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'console\fixtures\backend',
            'globalFixtures' => [
                'yii\test\InitDb',
            ],
        ],
        'fixture-frontend' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'console\fixtures\frontend',
            'globalFixtures' => [
                'yii\test\InitDb',
            ],
        ],
    ],
    'modules' => [
        /* @see \yii\base\Module::modules */
        'gii' => 'yii\gii\Module', // to get more info  by 'gii' execute in console "php yii help gii"
    ],
];
