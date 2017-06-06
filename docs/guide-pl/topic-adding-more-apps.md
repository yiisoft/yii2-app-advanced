Dodawanie kolejnych aplikacji
=============================

Powszechnie spotykane rozdzielenie części front-endowej od back-endowej czasem nie jest wystarczające. Dla przykładu, 
być może wymagane jest wydzielenie jeszcze jednej aplikacji, dla, powiedzmy, bloga. Aby to uzyskać:

1. Skopiuj folder `frontend` do folderu `blog`, `environments/dev/frontend` do `environments/dev/blog` 
   i `environments/prod/frontend` do `environments/prod/blog`.
2. Popraw przestrzenie nazw i ścieżki tak, aby zaczynały się od `blog` zamiast `frontend`.
3. W pliku `common\config\bootstrap.php` dodaj `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
4. Zmodyfikuj zawartość pliku `environments/index.php` (dodane linie zostały oznaczone `+`):

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
