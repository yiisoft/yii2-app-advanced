Configurando Composer
=====================

Después de instalar el proyecto plantilla es una buena idea ajustar el archivo `composer.json` por defecto que puedes encontrar en el directorio raíz:

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

En primer lugar estamos actualizando la informatión básica. Cambie el `name`, `description`, `keywords`, `homepage` y `support` para que coincida con tu proyecto.

Ahora la parte interesante. Puedes añadir mas paquetes que necesites para tu application en la sección `require`.
Todos estos paquetes están alojadas en [packagist.org](https://packagist.org/) asi que sientete libre de navegar por el sitio web para buscar código util.

Después de cambiar tu `composer.json` puedes ejecutar `composer update --prefer-dist`, espera a que se descarguen los paquetes y se instalen y después ya están listos para usarlos. El carga automatica de clases será manejado de forma automatica.
