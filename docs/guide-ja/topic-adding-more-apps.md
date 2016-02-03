アプリケーションをさらに追加する
================================

独立したフロントエンドとバックエンドを持つのが普通ですが、時には、それでは足りない場合もあります。
例えば、そうですね、ブログのために追加のアプリケーションが必要かも知れません。
そのためには、

1. `frontend` を `blog` に、`environments/dev/frontend` を `environments/dev/blog` に、そして、
`environments/prod/frontend` を `environments/prod/blog` にコピーします。
2. 名前空間とパスが `frontend` ではなく `blog` で始まるように修正します。
3. `common\config\bootstrap.php` に、`Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');` を追加します。
