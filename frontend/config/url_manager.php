<?php

return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<_a:login|logout>' => 'auth/auth/<_a>',

        'contact' => 'site/contact',
        '<action>' => '<action>/index',
    ],
];
