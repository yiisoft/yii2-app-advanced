共有ホスティング環境でアドバンスト・プロジェクト・テンプレートを使う
================================================================

アドバンスト・プロジェクト・テンプレートを共有ホストに配備するのは、ベーシック・プロジェクト・テンプレートを配備するのに比べると、少しトリッキーになります。
なぜなら、アドバンスト・アプリケーションは、共有ホストがサポートしていない二つのウェブ・ルートを持っているからです。
ディレクトリ構造を修正して、フロントエンドの URL が `http://site.test` となり、
バックエンドの URL が `http://site.test/admin` となるようにしなければなりません。

### エントリ・スクリプトを単一のウェブ・ルートに移動する

まずは、ウェブ・ルート・ディレクトリが必要です。
新しいディレクトリを作成して、あなたのホストのウェブ・ルートの名前に合った名前を付けて下さい。
例えば、`www` や `public_html` や、そのような名前です。
そして、次のようなディレクトリ構成にします。ここで `www` は、たった今作成したホストのウェブ・ルート・ディレクトリを指します。

```
www
    admin
backend
common
console
environments
frontend
...
```

`www` が私たちのフロントエンドのディレクトリになりますので、`frontend/web` のコンテンツをこの中に移動します。
`backend/web` のコンテンツは `www/admin` に移動します。
 どちらの場合も、index.php および index-test.php の中のパスを修正する必要があります。

### セッションとクッキーを修正する

元来は、バックエンドとフロントエンドは異なるドメインで走ることを意図されています。
両方を同じドメインに移動すると、フロントエンドとバックエンドが同じクッキーを共有して、衝突することになります。
この障害を修正するために、バックエンドのアプリケーション構成 backend/config/main.php を以下のように修正します。

```php
'components' => [
    'request' => [
        'csrfParam' => '_csrf-backend',
        'csrfCookie' => [
            'httpOnly' => true,
            'path' => '/admin',
        ],
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_identity-backend',
            'path' => '/admin',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        // これがバックエンドへのログインに使用されるセッション・クッキーの名前
        'name' => 'advanced-backend',
        'cookieParams' => [
            'path' => '/admin',
        ],
    ],
],
```

### 別のセットアップ

テンプレートをセットアップする上記の方法があなたにとってはうまく行かない場合は、
[Oleg Belostotskiy による構成とドキュメント](https://github.com/mickgeek/yii2-advanced-one-domain-config) を試してみて下さい。
