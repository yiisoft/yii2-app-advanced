Configuración y entornos
========================

Hay múltiples problemas con un enfoque típico de configuración:

- Cada miembro del equipo tiene su propias opciones de configuración. Comiteando tal configuración afectará a otros miembros del equipo.
- La contraseña de la base de datos de producción y las claves de la API no deberían terminar en el repositorio.
- Hay múltiples entornos de servidor: desarrollo, testeo, producción. Cada uno debería tener su propia configuración.
- Definiendo todas las opciones de configuración para cada caso es muy repetitivo y toma demasiado tiempo para mantenerlo.

En el orden de solventar estas incidencias Yii introduce un concepto de entorno simple. Cada entorno es presentado por un conjunto de ficheros
bajo el directorio `enviroments`. El comando `init` es usado para cambiar entre estos. Lo que realmente hace es copiar todo lo que este bajo el directorio
environment hacia el directorio raíz donde están todas las aplicaciones.

Por defecto hay dos entornos: `dev` y `prod`. El primero es para desarrollo. Tiene todas las herramientas para desarrollo y la depuración activada.
El segundo es para el despliegue al servidor. Tiene la depuración y las herramientas de desarrollo desactivadas.

El entorno normalmente contiene los ficheros bootstrap de la aplicación tales como `index.php` y ficheros de configuración con el sufijo `-local.php`. Estas
son las configuraciones personales de los miembros del equipo las cuales estás frecuentemente en el entorno `dev` o configuraciones especificas del servidor. Por ejemplo,
la conexión de base de datos de producción podría estar en la configuración de entorno `prod` `-local.php`. Estas configuraciones locales son añadidas a `.gitignore` y nunca
enviadas al condigo fuente de tu repositorio.

En el orden de evitar duplicación de configuraciones estas sobrescriben cada una de las otras. Por ejemplo, el frontend lee la configuración en el siguiente orden:

- `common/config/main.php`
- `common/config/main-local.php`
- `frontend/config/main.php`
- `frontend/config/main-local.php`

Los parámetros son leídos en el siguiente orden:

- `common/config/params.php`
- `common/config/params-local.php`
- `frontend/config/params.php`
- `frontend/config/params-local.php`

El ultimo fichero de configuración sobrescribe el anterior.

Este es el esquema entero:

![Configuración de la Aplicación Avanzada](images/advanced-app-configs.png)
