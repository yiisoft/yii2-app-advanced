Instalación
===========

## Requerimientos

El requerimiento mínimo para esta plantilla es que su servidor web soporte PHP 5.6.0.

## Instalación usando Composer

Si no tienes [Composer](http://getcomposer.org/), sigue las instrucciones en la sección [Instalando Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/start-installation.md#installing-via-composer) de la guía definitiva para instalarlo.

Con Composer instalado, puedes entonces instalar la aplicación usando los siguientes comandos:

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

El comando instala la aplicación avanzada en un directorio nombrado `yii-application`.
Puedes elegir un nombre de directorio diferente si tu quieres.

## Instalación desde un Archivo

Extrae el archivo descargado desde [yiiframework.com](http://www.yiiframework.com/download/) a directorio nombrado `advanced` que está directamente bajo el Web root.

A continuación sigue las siguientes instrucciones dadas en la siguiente sub-sección.


## Preparando la aplicación

Después de instalar la aplicación, tienes que realizar los siguientes pasos para la instalación de la aplicación. Solo necesitas hacer esto la primera vez.

1. Ejecuta el comando `init` y selecciona `dev` como entorno.

   ```
   php /path/to/yii-application/init
   ```

   Por otra parte, en producción ejecuta `init` con el modo no interactivo.

   ```
   php /path/to/yii-application/init --env=Production --overwrite=All --delete=All
   ```

2. Crea una nueva base de datos y ajusta la configuración de `components['db']` en `common/config/main-local.php` como corresponde.

3. Aplica las migraciones con el comando de consola `yii migrate`.

4. Establece los documentos raíces(document-root) de tu servidor web:

   - para frontend `/path/to/yii-application/frontend/web/` y usando la URL `http://frontend.test/`
   - para backend `/path/to/yii-application/backend/web/` y usando la URL `http://backend.test/`

   Para Apache podría ser lo siguiente:

   ```apache
       <VirtualHost *:80>
           ServerName frontend.test
           DocumentRoot "/path/to/yii-application/frontend/web/"

           <Directory "/path/to/yii-application/frontend/web/">
               # use mod_rewrite for pretty URL support
               RewriteEngine on
               # If a directory or a file exists, use the request directly
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # Otherwise forward the request to index.php
               RewriteRule . index.php

               # use index.php as index file
               DirectoryIndex index.php

               # ...other settings...
           </Directory>
       </VirtualHost>

       <VirtualHost *:80>
           ServerName backend.test
           DocumentRoot "/path/to/yii-application/backend/web/"

           <Directory "/path/to/yii-application/backend/web/">
               # use mod_rewrite for pretty URL support
               RewriteEngine on
               # If a directory or a file exists, use the request directly
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # Otherwise forward the request to index.php
               RewriteRule . index.php

               # use index.php as index file
               DirectoryIndex index.php

               # ...other settings...
           </Directory>
       </VirtualHost>
   ```

   For nginx:

   ```nginx
       server {
           charset utf-8;
           client_max_body_size 128M;

           listen 80; ## listen for ipv4
           #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

           server_name frontend.test;
           root        /path/to/yii-application/frontend/web/;
           index       index.php;

           access_log  /path/to/yii-application/log/frontend-access.log;
           error_log   /path/to/yii-application/log/frontend-error.log;

           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php$is_args$args;
           }

           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               fastcgi_pass   127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }

           location ~ /\.(ht|svn|git) {
               deny all;
           }
       }

       server {
           charset utf-8;
           client_max_body_size 128M;

           listen 80; ## listen for ipv4
           #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

           server_name backend.test;
           root        /path/to/yii-application/backend/web/;
           index       index.php;

           access_log  /path/to/yii-application/log/backend-access.log;
           error_log   /path/to/yii-application/log/backend-error.log;

           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php$is_args$args;
           }

           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               fastcgi_pass   127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }

           location ~ /\.(ht|svn|git) {
               deny all;
           }
       }
   ```

5. Cambia los ficheros hosts que apuntan al dominio de tu servidor.

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   Añade las siguientes lineas:

   ```
   127.0.0.1   frontend.test
   127.0.0.1   backend.test
   ```

Para loguearte dentro de la aplicación, necesitas primero registrarte, con cualquiera de sus correos electrónicos, nombre de usuario y contraseña.
A continuación puedes loguearte dentro de la aplicación con el mismo correo electrónico y la contraseña en cualquier momento.
