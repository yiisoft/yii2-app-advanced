Adding more applications
========================

While having separate frontend and backend is common, sometimes it's not enough. For example, you may need additional
application for, say, a blog. In order to get it:

1. Copy `frontend` to `blog`, `environments/dev/frontend` to `environments/dev/blog` and `environments/prod/frontend`
to `environments/prod/blog`.
2. Adjust namespaces and paths to start with `blog` instead of `frontend`.
3. In `common\config\bootstrap.php` add `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
4. Make adjustments to `environments/index.php` (marked with `+`):

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
