<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'cms' => [
        'components' => [
            '@common/config/content/components.php'
        ],
        'fields' => [
            '@common/config/content/fields.php'
        ],
        'views' => [
            '@common/config/content/views.php'
        ]
    ]
];
