Composer を構成する
===================

プロジェクト・テンプレートがインストールされた後に、ルート・ディレクトリにあるデフォルトの `composer.json`
を修正するのは良い考えです。

```json
{
    "name": "yiisoft/yii2-app-advanced",
    "description": "Yii 2 Advanced Project Template",
    "keywords": ["yii2", "framework", "advanced", "project template"],
    "homepage": "http://www.yiiframework.com/",
    "type": "project",
    "license": "BSD-3-Clause",
    "support": {
        "issues": "https://github.com/yiisoft/yii2/issues?state=open",
        "forum": "http://www.yiiframework.com/forum/",
        "wiki": "http://www.yiiframework.com/wiki/",
        "irc": "irc://irc.freenode.net/yii",
        "source": "https://github.com/yiisoft/yii2"
    },
    "minimum-stability": "dev",
    "require": {
        "php": ">=5.6.0",
        "yiisoft/yii2": "~2.0.14",
        "yiisoft/yii2-bootstrap5": "~2.0.0",
        "yiisoft/yii2-symfonymailer": "~2.0.0"
    },
    "require-dev": {
        "yiisoft/yii2-debug": "~2.1.0",
        "yiisoft/yii2-gii": "~2.2.0",
        "yiisoft/yii2-faker": "~2.0.0",
        "codeception/codeception": "^4.0",
        "codeception/module-asserts": "^1.0",
        "codeception/module-yii2": "^1.0",
        "codeception/module-filesystem": "^1.0",
        "phpunit/phpunit": "~5.7.27 || ~6.5.5",
        "codeception/verify": "~0.5.0 || ~1.1.0",
        "symfony/browser-kit": ">=2.7 <=4.2.4"
    },
    "config": {
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
