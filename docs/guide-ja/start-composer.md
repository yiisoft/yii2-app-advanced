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
        "php": ">=5.4.0",
        "yiisoft/yii2": "~2.0.6",
        "yiisoft/yii2-bootstrap": "~2.0.0",
        "yiisoft/yii2-swiftmailer": "~2.0.0"
    },
    "require-dev": {
        "yiisoft/yii2-debug": "~2.0.0",
        "yiisoft/yii2-gii": "~2.0.0",
        "yiisoft/yii2-faker": "~2.0.0",

        "codeception/base": "^2.2.3",
        "codeception/verify": "~0.3.1"
    },
    "config": {
        "process-timeout": 1800
    },
    "extra": {
        "asset-installer-paths": {
            "npm-asset-library": "vendor/npm",
            "bower-asset-library": "vendor/bower"
        }
    }
}
```

最初に、基本的な情報を更新しましょう。
`name`、`description`、`keywords`、`homepage` および `support` をあなたのプロジェクトに合うように変更します。

次に興味深い部分です。あなたは、あなたのアプリケーションが必要とするパッケージを `require` セクションに追加することが出来ます。
追加のパッケージは全て [packagist.org](https://packagist.org/) から取ってくることが出来ます。ウェブ・サイトを閲覧して、役に立つコードを探してください。

`composer.json` を修正した後、`composer update --prefer-dist` を実行し、パッケージがダウンロードされインストールされるのを待ちます。
後はただ使用するだけです。クラスのオートロードは自動的に処理されます。
