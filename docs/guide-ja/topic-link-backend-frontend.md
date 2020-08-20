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

## ハードコードされた hostInfo URL

上記の例はフィールドに何を入れるべきかを示すためのものです。`hostInfo` には `https://example.com` または `https://backend.example.com` のようなフル・ドメイン名を入れなければなりません。
構成ファイルにハードコードされたドメインを記載するのはあまり実用的ではありません。
特に複数の環境 (ローカルの開発環境、ステージング、実運用環境) を持つ場合は不便です。

いくつかの方法がありますが、以下に示すのは Yii の環境変数と `init` プロセスを利用する方法です。

最初に Composer のオートロードの段階で関数をロードする必要があります。

`composer.json` ファイルに以下を追加します。

```json
"autoload": {
    "files": [
        "common/functions.php"
    ]
}
```

そして `common/functions.php` を作成します。

```php
<?php
/**
 * `index.php` ファイルに `define('USE_HTTPS', true)` という行が必要
 */
function getUrlScheme()
{
    return (USE_HTTPS === true) ? 'https' : 'http';
}

/**
 * `index.php` ファイルに `define('DOMAIN_NAME', 'example.tld')` という行が必要
 */
function getDomain($subDomain = null)
{
    $sub = $subDomain ? $subDomain . '.' : '';
    return getUrlScheme() . '://' . $sub . DOMAIN_NAME;
}
```

そして、対応する `web/index.php` ファイルで定数を定義する必要があります。下記はデフォルトの諸環境のための `web/index.php` ファイルのパスです。

```
environments/dev/backend/web/index.php
environments/dev/frontend/web/index.php
environments/prod/backend/web/index.php
environments/prod/frontend/web/index.php
```

`dev` 版では、ロカール開発環境のドメイン名 (例: mylocalsite.test) を使い、`prod` 版では実際のドメイン名 (例: example.com) を使うことになります。

index ファイルの先頭に追加します。

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

`./init` を実行して、適切な環境で変更点を上書きします。

関数を直接に使用することも、エイリアスを作成することも出来ます。ここではエイリアスを作りましょう。

下記を `common/config/bootstrap.php` に追加します。

```php
Yii::setAlias('@frontendDomain', getDomain());              // ex: https://somedomain.tld
Yii::setAlias('@backendDomain', getDomain('backend'));      // ex: https://backend.somedomain.tld
```

`www` がサブ・ドメインであることを思い出して下さい。ですから `www` を使う場合はそれを渡します。すなわち: `getDomain('www')`

以上の設定が全て終れば、最後にメインの構成ファイルでエイリアスを使用するだけです。

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
            'class' => 'yii\web\UrlManager',        // 名前を変えた URL マネージャはクラスの指定が必要 !
            'hostInfo' => Yii::getAlias('@frontendDomain'),    // リンクに使用するフル・ベース・ドメイン名
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/frontend-rules.php'),
        ],
        // ...

    ],
    // ...
];
```
