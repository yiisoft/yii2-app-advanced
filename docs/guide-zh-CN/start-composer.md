配置 Composer
=============

安装项目模板后，最好调整默认的 `composer.json` ，它可以在根目录下找到：

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

首先，我们要更新基本信息。 更改 `name` ，`description` ，`keywords` ，`homepage` 和 `support` 来匹配您的项目。

接下来是见证奇迹的时刻. 您可以将您的应用程序需要的更多包添加到 `require` 部分。
所有这些包都来自 [packagist.org](https://packagist.org/) 浏览这里你可以找到更多的实用的免费代码。

在你的 `composer.json` 改变之后，你可以运行 `composer update --prefer-dist` ，等待程序包下载完成，安装后，就可以使用它们了。 包里面所有的类都会自动加载。
