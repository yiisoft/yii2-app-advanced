アプリケーションをさらに追加する
================================

独立したフロントエンドとバックエンドを持つのが普通ですが、時には、それでは足りない場合もあります。
例えば、そうですね、ブログのために追加のアプリケーションが必要かも知れません。そのためには、

1. `frontend` を `blog` に、`environments/dev/frontend` を `environments/dev/blog` に、そして、
`environments/prod/frontend` を `environments/prod/blog` にコピーします。
2. 名前空間とパスが `frontend` ではなく `blog` で始まるように修正します。
3. `common\config\bootstrap.php` に、`Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');` を追加します。
4. `environments/index.php` を修正します (`+` 印の個所):

```php
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
+           'blog/runtime',
+           'blog/web/assets',
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
+           'blog/config/main-local.php',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'frontend/runtime',
            'frontend/web/assets',
+           'blog/runtime',
+           'blog/web/assets',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
+           'blog/config/main-local.php',
        ],
    ],
];
```
