Composer を構成する
===================

プロジェクト・テンプレートがインストールされた後に、ルート・ディレクトリにあるデフォルトの `composer.json`
を修正するのは良い考えです。

```json
{
    "name": "yiisoft/yii2-app-advanced",
    "description": "Yii 2 Advanced Project Template",
    "keywords": ["yii2", "framework", "advanced", "project template"],
    "homepage": "https://www.yiiframework.com/",
    "type": "project",
    "license": "BSD-3-Clause",
    "support": {
        "issues": "https://github.com/yiisoft/yii2/issues?state=open",
        "forum": "https://www.yiiframework.com/forum/",
        "wiki": "https://www.yiiframework.com/wiki/",
        "irc": "ircs://irc.libera.chat:6697/yii",
        "source": "https://github.com/yiisoft/yii2"
    },
    "minimum-stability": "dev",
    "require": {
        "php": ">=7.4.0",
        "yiisoft/yii2": "~2.0.45",
        "yiisoft/yii2-bootstrap5": "~2.0.2",
        "yiisoft/yii2-symfonymailer": "~2.0.3"
    },
    "require-dev": {
        "yiisoft/yii2-debug": "~2.1.0",
        "yiisoft/yii2-gii": "~2.2.0",
        "yiisoft/yii2-faker": "~2.0.0",
        "phpunit/phpunit": "~9.5.0",
        "codeception/codeception": "^5.0.0 || ^4.0",
        "codeception/lib-innerbrowser": "^4.0 || ^3.0 || ^1.1",
        "codeception/module-asserts": "^3.0 || ^1.1",
        "codeception/module-yii2": "^1.1",
        "codeception/module-filesystem": "^3.0 || ^2.0 || ^1.1",
        "codeception/verify": "^3.0 || ^2.2",
        "symfony/browser-kit": "^6.0 || >=2.7 <=4.2.4"
    },
    "autoload-dev": {
        "psr-4": {
            "common\\tests\\": ["common/tests/", "common/tests/_support"],
            "backend\\tests\\": ["backend/tests/", "backend/tests/_support"],
            "frontend\\tests\\": ["frontend/tests/", "frontend/tests/_support"]
        }
    },
    "config": {
        "allow-plugins": {
            "yiisoft/yii2-composer" : true
        },
        "process-timeout": 1800,
        "fxp-asset": {
            "enabled": false
        }
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://asset-packagist.org"
        }
    ]
}
```

最初に、基本的な情報を更新しましょう。
`name`、`description`、`keywords`、`homepage` および `support` をあなたのプロジェクトに合うように変更します。

次に興味深い部分です。あなたは、あなたのアプリケーションが必要とするパッケージを `require` セクションに追加することが出来ます。
追加のパッケージは全て [packagist.org](https://packagist.org/) から取ってくることが出来ます。ウェブ・サイトを閲覧して、役に立つコードを探してください。

`composer.json` を修正した後、`composer update --prefer-dist` を実行し、パッケージがダウンロードされインストールされるのを待ちます。
後はただ使用するだけです。クラスのオートロードは自動的に処理されます。
