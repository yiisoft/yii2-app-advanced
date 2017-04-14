<?php

use mobilejazz\yii2\cms\common\models\User;

return [
    'admin' => [
        'id' => 1,
        'email' => 'admin@example.com',
        'auth_key' => 'iXFcxMTaoKTBTarcfumlYbFEx-gT10SF',
        'password_hash' => '$2y$13$fPuUtK5qUIsHV6BRgKovcuWFmbVn4tm/YM8SSPInwNbcWj7z2hFLC',
        'name' => 'Admin',
        'last_name' => 'User',
        'role' => User::ROLE_ADMIN,
        'status' => User::STATUS_ACTIVE,
        'created_at' => 1492173013,
        'updated_at' => 1492173013
    ],
    'editor' => [
        'id' => 2,
        'email' => 'editor@example.com',
        'auth_key' => 'Dv7oEAxID8fVC1IFY4-p-m8FPnNH49TE',
        'password_hash' => '$2y$13$HIIYMq1vYtqvTXE8aSbyGuVQa/EtW2krWrTdmb9T3N5J1buvh7NAy',
        'name' => 'Editor',
        'last_name' => 'User',
        'role' => User::ROLE_EDITOR,
        'status' => User::STATUS_ACTIVE,
        'created_at' => 1492173013,
        'updated_at' => 1492173013
    ],
    'translator' => [
        'id' => 3,
        'email' => 'translator@example.com',
        'auth_key' => 'CIx3QpOTSqEBi9larCqIcK98Bs1WO4gu',
        'password_hash' => '$2y$13$3mmKyF9qdUa0JKHZwE7Mr.cNB/HjpQWUSGom2kA0.hE.t8wNb62Fu',
        'name' => 'Translator',
        'last_name' => 'User',
        'role' => User::ROLE_TRANSLATOR,
        'status' => User::STATUS_ACTIVE,
        'created_at' => 1492173013,
        'updated_at' => 1492173013
    ],
    'simple' => [
        'id' => 4,
        'email' => 'simple@example.com',
        'auth_key' => '0cSF5wjZx3XxRVF16N2wyzoYiBa5oDhE',
        'password_hash' => '$2y$13$/Xbf8RrLGpI7TlVYZdp9leNuZpWMHQ2G6KPDwo7ZhDvtU4Y9PyuDe',
        'name' => 'Simple',
        'last_name' => 'User',
        'role' => User::ROLE_USER,
        'status' => User::STATUS_ACTIVE,
        'created_at' => 1492173013,
        'updated_at' => 1492173013
    ]
];