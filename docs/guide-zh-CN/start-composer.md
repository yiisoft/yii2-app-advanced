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

首先，我们要更新基本信息。 更改 `name` ，`description` ，`keywords` ，`homepage` 和 `support` 来匹配您的项目。

接下来是见证奇迹的时刻. 您可以将您的应用程序需要的更多包添加到 `require` 部分。
所有这些包都来自 [packagist.org](https://packagist.org/) 浏览这里你可以找到更多的实用的免费代码。

在你的 `composer.json` 改变之后，你可以运行 `composer update --prefer-dist` ，等待程序包下载完成，安装后，就可以使用它们了。 包里面所有的类都会自动加载。