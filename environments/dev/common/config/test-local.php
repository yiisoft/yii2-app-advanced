<?php
return [
    'components' => [
        'db' => [
            'dsn' => getenv('DB_TEST_DSN'),
        ],
    ],
];
