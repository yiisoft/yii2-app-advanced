<?php
return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::className(),
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
        ],
    ],
];
