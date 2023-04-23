Installation
============

## Exigences

L'exigence minimum de ce modèle de projet est que votre serveur Web prenne en charge PHP 5.6.0.

## Installation via Composer

Si vous n'avez pas [Composer](https://getcomposer.org/), suivez les instructions de la section
[Installation de Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide/start-installation.md#installing-via-composer) du guide complet de Yii pour l'installer.

Une fois composer installé, vous pouvez l'utiliser pour installer l'application en utilisant les commandes suivantes :

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

La commande installe l'application avancée dans un dossier nommé `yii-application`. 
Vous avez le droit de choisir un autre nom de dossier si vous le désirez.

## Installation à partir d'un fichier archive

Extrayez l'archive que vous avez téléchargée depuis [yiiframework.com](https://www.yiiframework.com/download/) dans un dossier nommé `advanced` placé directement sous la racine Web.

Ensuite suivez les instructions données dans la sous-section suivante.


## Préparation de l'application

Après que vous avez installé l'application, vous devez accomplir les étapes suivantes pour initialiser l'application installée. Vous n'avez à faire cela qu'une fois pour toute.

1. Ouvrez un terminal et exécutez la commande `init` et sélectionnez `dev` en tant qu'environnement. 

   ```
   /path/to/php-bin/php /path/to/yii-application/init
   ```

   Si vous l'automatisez à l'aide d'un script, vous pouvez exécuter `init` en mode non interactif.

   ```
   /path/to/php-bin/php /path/to/yii-application/init --env=Production --overwrite=All --delete=All
   ```

2. Créez une nouvelle base de données et complétez la configuration de `components['db']` dans `common/config/main-local.php` en conséquence.

3. Ouvrez un terminal, appliquez les migrations avec la commande `/path/to/php-bin/php /path/to/yii-application/yii migrate`.

4. Définissez la racine du document de votre serveur Web :

   - pour l'interface utilisateur (frontend)  `/path/to/yii-application/frontend/web/`, en utilisant l'URL `http://frontend.test/`
   - pour l'interface d'administration (backend) `/path/to/yii-application/backend/web/`, en utilisant URL `http://backend.test/`

    Avec le serveur Apache ça pourrait ressembler à ceci :

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
               # Apache 2.4
               Require all granted
               
               ## Apache 2.2
               # Order allow,deny
               # Allow from all
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
               # Apache 2.4
               Require all granted
               
               ## Apache 2.2
               # Order allow,deny
               # Allow from all
           </Directory>
       </VirtualHost>
   ```

   Avec le serveur nginx:

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

           # deny accessing php files for the /assets directory
           location ~ ^/assets/.*\.php$ {
               deny all;
           }

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               fastcgi_pass 127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }
       
           location ~* /\. {
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

           # deny accessing php files for the /assets directory
           location ~ ^/assets/.*\.php$ {
               deny all;
           }

           location ~ \.php$ {
               include fastcgi_params;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               fastcgi_pass 127.0.0.1:9000;
               #fastcgi_pass unix:/var/run/php5-fpm.sock;
               try_files $uri =404;
           }
       
           location ~* /\. {
               deny all;
           }
       }
   ```

5. Modifier le fichier hosts pour qu'il pointe sur le domaine ad hoc. 

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   Ajoutez les lignes suivantes :

   ```
   127.0.0.1   frontend.test
   127.0.0.1   backend.test
   ```

Pour vous connecter à l'application, vous devez d'abord vous enregistrer avec votre adresse électronique, votre nom d'utilisateur et votre mot de passe.
Ensuite, vous pouvez utiliser cet adresse électronique et ce mot de passe à tout moment.



> Note : si vous voulez utiliser le modèle avancé sur un domaine unique de manière à ce que `/` soit l'interface utilisateur et  `/admin` l'interface d'administration, reportez-vous 
> à [Utilisation du modèle de projet avancé sur un hébergement partagé](topic-shared-hosting.md).

## Installation en utilisant Vagrant

C'est la manière la plus facile mais elle prend du temps (~20 min).

**Cette façon d'installer ne nécessite pas de logiciel pré-installé (comme un serveur Web, PHP, MySQL, etc.)** - contentez-vous d'accomplir les étapes suivantes !

#### Manuel pour les utilisateurs de  Linux/Unix 

1. Installez [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Installez [Vagrant](https://www.vagrantup.com/downloads.html)
3. Créez un [jeton d'API personnel](https://github.com/blog/1509-personal-api-tokens) sur GitHub
3. Préparez le projet:
   
   ```bash
   git clone https://github.com/yiisoft/yii2-app-advanced.git
   cd yii2-app-advanced/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. Placez votre jeton personnel d'API GitHub dans `vagrant-local.yml`
5. Placez-vous (cd) sur la racine du projet :

   ```bash
   cd yii2-app-advanced
   ```

5. Exécutez les commandes suivantes :

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
C'est tout. Il ne vous reste plus qu'à attendre la fin de l'exécution ! Après cela, vous pouvez accéder au projet localement par les URL :
* pour l'interface utilisateur : http://y2aa-frontend.test
* pour l'interface d'administration : http://y2aa-backend.test
   
#### Manuel pour les utilisateurs de Windows

1. Installez [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Installez [Vagrant](https://www.vagrantup.com/downloads.html)
3. Redémarrez.
4. Créez un [jeton d'API personnel](https://github.com/blog/1509-personal-api-tokens) sur GitHub
5. Préparez le projet :
   * téléchargez le dépôt [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced/archive/master.zip)
   * décompressez-le avec unzip
   * placez-vous dans le dossier `yii2-app-advanced-master/vagrant/config`
   * copiez `vagrant-local.example.yml` vers `vagrant-local.yml`

6. Placez votre jeton personnel d'API GitHub dans `vagrant-local.yml`
7. Ajoutez les lignes suivantes dans le  [fichier hosts](https://en.wikipedia.org/wiki/Hosts_(file)):
   
   ```
   192.168.83.137 y2aa-frontend.test
   192.168.83.137 y2aa-backend.test
   ```

8. Ouvrez un terminal (`cmd.exe`), **placez-vous à la racine du projet** et exécutez les commandes :

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
   (Vous pouvez apprendre comment changer de dossier dans l'interpréteur de commande en lisant [ceci](https://www.wikihow.com/Change-Directories-in-Command-Prompt))

C'est tout. Il ne vous reste qu'à attendre la fin de l'exécution ! Après cela, vous pouvez accéder au projet localement par les URL :
* pour l'interface utilisateur : http://y2aa-frontend.test
* pour l'interface d'administration : http://y2aa-backend.test

