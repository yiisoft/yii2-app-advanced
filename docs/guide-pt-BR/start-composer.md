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
        "php": ">=5.4.0",
        "yiisoft/yii2": "*",
        "yiisoft/yii2-bootstrap": "*",
        "yiisoft/yii2-swiftmailer": "*"
    },
    "require-dev": {
        "yiisoft/yii2-codeception": "*",
        "yiisoft/yii2-debug": "*",
        "yiisoft/yii2-gii": "*",
        "yiisoft/yii2-faker": "*"
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

Primeiro vamos alterar as informações básicas. Modifique `name`, `description`, `keywords`, `homepage` e `support` 
para corresponder as informações do seu projeto.

Agora a parte interessante. Você pode adicionar mais pacotes que a sua aplicação necessita, na seção `require`.
Todos os pacotes são provindos do [packagist.org](https://packagist.org/) então, sinta-se a vontade para procurar 
pacotes úteis no website.

Após alterar seu `composer.json` você pode executar o comando `composer update --prefer-dist`, aguardar o download e 
instalação dos pacotes e depois utilizá-los. Todas as classes são carregadas automaticamente através de autoloading. 