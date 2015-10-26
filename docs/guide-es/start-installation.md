Instalacion
============

## Requisitos

El requerimiento minimo para esta plantilla de proyecto es que su servidor Web Soporte PHP 5.4.0

## Instalacion usando composer

Si no tienes [Composer](http://getcomposer.org/), y sigue las instrucciones en la seccion [Instalando YII](https://github.com/yiisoft/yii2/blob/master/docs/guide/start-installation.md#installing-via-composer) de la guia definitiva para instalarlo.

Con composer instalado, Puedes entonces instalar la aplicacion usando los siguientes comandos:

    composer global require "fxp/composer-asset-plugin:~1.0.3" 

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

El primer comando instala el [El plugin activo(asset plugin) de composer ](https://github.com/francoispluchino/composer-asset-plugin/) el cual permite el manejo de los paquetes de las dependencias Bower y npm a traves de composer
Sólo tiene que ejecutar este comando una vez para todas las plantillas avanzados. 
El segundo comando instala la aplicación avanzada en un directorio llamado yii-aplicación. Usted puede elegir un nombre de directorio diferente si lo desea.

## Instalacion de un Archivo

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `advanced` that is directly under the Web root.

Then follow the instructions given in the next subsection.


## Preparing application

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Ejecutar el comando  `init`  y selecciona  `dev` Como entorno.

   ```
   php /path/to/yii-application/init
   ```

   Otherwise, in production execute `init` in non-interactive mode.

   ```
   php /path/to/yii-application/init --env=Production --overwrite=All
   ```

2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

3. Apply migrations with console command `yii migrate`.

4. Set document roots of your web server:

   - for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend.dev/`
   - for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend.dev/`

   For Apache it could be the following:

   ```apache
       <VirtualHost *:80>
           ServerName frontend.dev
           DocumentRoot /path/to/yii-application/frontend/web/
           
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
           ServerName backend.dev
           DocumentRoot /path/to/yii-application/backend/web/
           
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
       
           server_name frontend.dev;
           root        /path/to/yii-application/frontend/web/;
           index       index.php;
       
           access_log  /path/to/yii-application/log/frontend-access.log;
           error_log   /path/to/yii-application/log/frontend-error.log;
       
           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php?$args;
           }
       
           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;
       
           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
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
       
           server_name backend.dev;
           root        /path/to/yii-application/backend/web/;
           index       index.php;
       
           access_log  /path/to/yii-application/log/backend-access.log;
           error_log   /path/to/yii-application/log/backend-error.log;
       
           location / {
               # Redirect everything that isn't a real file to index.php
               try_files $uri $uri/ /index.php?$args;
           }
       
           # uncomment to avoid processing of calls to non-existing static files by Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;
       
           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
               fastcgi_pass   127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }
       
           location ~ /\.(ht|svn|git) {
               deny all;
           }
       }
   ```

5. Change the hosts file to point the domain to your server.

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   Add the following lines:

   ```
   127.0.0.1   frontend.dev
   127.0.0.1   backend.dev
   ```

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.
