<?php
/**
 * Data set backed up by UserFixture to users (login: Bob, password: Z1ON0101)
 * Note: Yii also can auto-generate fixtures for you based on some template. You can generate your fixtures with different
 * data on different languages and formats. These feature is done by Faker library and yii2-faker extension.
 * @see https://github.com/yiisoft/yii2-faker extension guide for more docs.
 */
return [
    [
        'username' => 'Bob',
        'auth_key' => 'v_OsDmKVeRgYO2RQgCJyYqO2okhMUrVA',
        'password_hash' => Yii::$app->security->generatePasswordHash('Z1ON0101'),
        'email' => 'e-mail@mail.org',
        'created_at' => time(),
        'updated_at' => time(),
    ],
];