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

En primer lugar estamos actualizando la informatión básica. Cambie el `name`, `description`, `keywords`, `homepage` y `support` para que coincida con tu proyecto.

Ahora la parte interesante. Puedes añadir mas paquetes que necesites para tu application en la sección `require`.
Todos estos paquetes están alojadas en [packagist.org](https://packagist.org/) asi que sientete libre de navegar por el sitio web para buscar código util.

Después de cambiar tu `composer.json` puedes ejecutar `composer update --prefer-dist`, espera a que se descarguen los paquetes y se instalen y después ya están listos para usarlos. El carga automatica de clases será manejado de forma automatica.
