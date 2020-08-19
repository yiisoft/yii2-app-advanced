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
            'class' => 'yii\web\UrlManager',        // 名前を変えた URL マネージャはクラスの指定が必要 !
            'hostInfo' => 'https://example.com',    // リンクに使用するフル・ベース・ドメイン名
            // ここにフロントエンドの URL マネージャの構成
        ],

    ],
];
```

URL マネージャは別のサブ・ドメインにある別のアプリのルート URL を魔法によって知ることは出来ません。そこで `hostinfo` パラメータの出番となります。
これが定義するフル・ドメイン名によって URL マネージャが絶対リンクを作成します。

フロントエンドだけでなく他のアプリ ([アプリケーションをさらに追加する](topic-adding-more-apps.md)) へのリンクを生成する必要があることもあるでしょう。複数のサブ・ドメイン上の複数のアプリに対応するために複数の URL マネージャを定義することが出来ます。

```php
return [
    'components' => [
        'urlManager' => [
            // ここに通常のバックエンドの URL マネージャの構成
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // 名前を変えた URL マネージャはクラスの指定が必要 !
            'hostInfo' => 'https://example.com',    // リンクに使用するフル・ベース・ドメイン名
            // ここにフロントエンドの URL マネージャの構成
        ],
        'urlManagerBlog' => [
            'class' => 'yii\web\UrlManager',            // 名前を変えた URL マネージャはクラスの指定が必要 !
            'hostInfo' => 'https://blog.example.com',   // リンクに使用するフル・ベース・ドメイン名
            // ここにブログの URL マネージャの構成
        ],

    ],
];
```

このように構成すると、フロントエンドを指す URL を次のようにして得ることが出来ます。

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

複数のアプリで繰り返す必要のあるカスタム・ルールがある場合は、それ自身の "rules" ファイルに保存するべきです。
そうすれば、変更が必要になったときに、一つのファイルを修正するだけですみます。

`common/config` ディレクトリに `rules` という名前の新しいフォルダを作成します。その中に全ての URL ルールを入れることにします。

そして `backend-rules.php` という名前のファイルと `frontend-rules.php` という名前のファイルを作成します。

対応するアプリがルールを持たない/必要としない場合は、空の配列を返すようにします。

```php
<?php
return [];
```

次はカスタム・ルールがある場合はこんな感じになるという一例です。

```php
<?php
return [
    'aff/<id:\d+>' => 'affiliate/index',
    'lp/<id:\d+>' => 'landing/index',
];
```

そして対応する URL マネージャからそれぞれのルール・ファイルを require/include します。

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            // バックエンドの URL マネージャ
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/backend-rules.php'),
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // 名前を変えた URL マネージャはクラスの指定が必要 !
            'hostInfo' => 'https://example.com',    // リンクに使用するフル・ベース・ドメイン名
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/frontend-rules.php'),
        ],
        // ...

    ],
    // ...
];
```

## Hardcoded hostInfo URL

The examples above are to illustrate what is expected in the field. `hostInfo` expects a full domain name like `https://example.com` or
`https://backend.example.com`. Having a hard-coded domain in your config isn't very practical. Especially for handling multiple environments
(local, staging, production, etc).

There are a few ways you can do this. The following way allows you to make use of Yii's environments and the `init` process.

We first need to load functions early on during Composer's autoload.

In your `composer.json` file, add the following:

```json
"autoload": {
    "files": [
        "common/functions.php"
    ]
}
```

Now create `common/functions.php`:

```php
<?php
/**
 * Requires `define('USE_HTTPS', true)` to be in your `index.php` file!
 */
function getUrlScheme()
{
    return (USE_HTTPS === true) ? 'https' : 'http';
}

/**
 * Requires `define('DOMAIN_NAME', 'example.tld')` to be in your `index.php` file!
 */
function getDomain($subDomain = null)
{
    $sub = $subDomain ? $subDomain . '.' : '';
    return getUrlScheme() . '://' . $sub . DOMAIN_NAME;
}
```

Now we need to define our constants in the corresponding `web/index.php` files. Here are the paths for the default environments.

```
environments/dev/backend/web/index.php
environments/dev/frontend/web/index.php
environments/prod/backend/web/index.php
environments/prod/frontend/web/index.php
```

In the `dev` copies, we will use our local development domain name (ie: mylocalsite.test) and in the `prod` copies we will use the real domain (ie: example.com).

Add to the top of the index files:

**environments/dev/backend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'mylocalsite.test');
```

**environments/dev/frontend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'mylocalsite.test');
```

**environments/prod/backend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'example.com');
```

**environments/prod/frontend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'example.com');
```

Run `./init` and initialize the proper environment to overwrite the changes.

We can use the functions directly, or create aliases. Let's create aliases.

Add the following in `common/config/bootstrap.php`:

```php
Yii::setAlias('@frontendDomain', getDomain());              // ex: https://somedomain.tld
Yii::setAlias('@backendDomain', getDomain('backend'));      // ex: https://backend.somedomain.tld
```

Remember `www` is a sub-domain, so pass it like one if you use it like so: `getDomain('www')`

Lastly, with all of that set up, you can simply use the aliases in your main config files:

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            // backend URL manager
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/backend-rules.php'),
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // class is required on custom named URL managers!
            'hostInfo' => Yii::getAlias('@frontendDomain'),    // the full base domain name to use for the links
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/frontend-rules.php'),
        ],
        // ...

    ],
    // ...
];
```
