バックエンドからフロントエンドへのリンクを作成する
==================================================

バックエンド・アプリケーションからフロントエンド・アプリケーションへのリンクを作成しなければならないことがよくあります。
フロントエンド・アプリケーションはそれ自身の URL マネージャ規則を持ち得ますので、それをバックエンド・アプリケーションのために別の名前で複製する必要があります。

```php
return [
    'components' => [
        'urlManager' => [
            // ここに通常のバックエンドの URL マネージャの構成
        ],
        'urlManagerFrontend' => [
            // ここにフロントエンドの URL マネージャの構成
        ],

    ],
];
```

このようにすると、フロントエンドを指す URL を次のようにして取得することが出来ます。

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

フロントエンドの規則をコピペしなくても済むように、最初にそれらの規則を独立した `urlsphp` ファイルに移しておくことが出来ます。

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

そして、後でこれを `urlManagerFrontend` の規則としても読み込めば良いわけです。
