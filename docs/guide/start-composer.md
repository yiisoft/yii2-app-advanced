Configuring Composer
====================

After the project template is installed it's a good idea to adjust default `composer.json` that can be found in the root
directory:

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

First we're updating basic information. Change `name`, `description`, `keywords`, `homepage` and `support` to match
your project.

Now the interesting part. You can add more packages your application needs to the `require` section.
All these packages are coming from [packagist.org](https://packagist.org/) so feel free to browse the website for useful code.

After your `composer.json` is changed you can run `composer update --prefer-dist`, wait till packages are downloaded and
installed and then just use them. Autoloading of classes will be handled automatically.
