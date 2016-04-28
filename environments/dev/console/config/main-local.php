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
            'namespace' => 'console\fixtures',
            'globalFixtures' => [
                'console\fixtures\common\User',
            ],
        ],
    ],
    'modules' => [
        /* @see \yii\base\Module::modules */
        'gii' => 'yii\gii\Module', // to get more info  by 'gii' execute in console "php yii help gii"
    ],
];
