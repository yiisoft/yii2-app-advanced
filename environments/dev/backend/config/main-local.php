<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ //here
              'model' => [
                  'class' => 'yii\gii\generators\model\Generator'
              ],
            'crud' => [ // generator name
                'class' => 'backend\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                   'admin-lte' => '@backend/generators/crud/admin-lte', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
