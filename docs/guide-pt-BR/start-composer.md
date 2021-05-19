Configurando o Composer
=======================

Após a instalação do template de projetos, é uma boa ideia ajustar o `composer.json` padrão, que pode ser encontrado 
no diretório raiz:


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

Primeiro vamos alterar as informações básicas. Modifique `name`, `description`, `keywords`, `homepage` e `support` 
para corresponder as informações do seu projeto.

Agora a parte interessante. Você pode adicionar mais pacotes que a sua aplicação necessita, na seção `require`.
Todos os pacotes são provindos do [packagist.org](https://packagist.org/) então, sinta-se a vontade para procurar 
pacotes úteis no website.

Após alterar seu `composer.json` você pode executar o comando `composer update --prefer-dist`, aguardar o download e 
instalação dos pacotes e depois utilizá-los. Todas as classes são carregadas automaticamente através de autoloading. 
