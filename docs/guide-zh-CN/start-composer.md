配置 Composer
=============

安装项目模板后，最好调整默认的 `composer.json` ，它可以在根目录下找到：

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
        "yiisoft/yii2-bootstrap4": "~2.0.0",
        "yiisoft/yii2-swiftmailer": "~2.0.0 || ~2.1.0"
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

首先，我们要更新基本信息。 更改 `name` ，`description` ，`keywords` ，`homepage` 和 `support` 来匹配您的项目。

接下来是见证奇迹的时刻. 您可以将您的应用程序需要的更多包添加到 `require` 部分。
所有这些包都来自 [packagist.org](https://packagist.org/) 浏览这里你可以找到更多的实用的免费代码。

在你的 `composer.json` 改变之后，你可以运行 `composer update --prefer-dist` ，等待程序包下载完成，安装后，就可以使用它们了。 包里面所有的类都会自动加载。
