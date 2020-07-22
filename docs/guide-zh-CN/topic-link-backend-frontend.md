创建从后端到前端的链接
=======================================

通常需要创建从后端应用程序到前端应用程序的链接。 由于前端应用程序可能包含自己的URL管理器规则，因此您需要通过将后端应用程序命名为不同的方式来复制后端应用程序：

```php
return [
    'components' => [
        'urlManager' => [
            // here is your normal backend url manager config
        ],
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
        ],

    ],
];
```

完成后，您可以获取指向前端的URL，如下所示：

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

为了不复制粘贴前端规则，你可以先将它们移动到单独的 `urls.php` 文件中：

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'urls.php',
        ],
        // ...

    ],
    // ...
];
```

之后，你可以将它包含在 `urlManagerFrontend` 规则中。
