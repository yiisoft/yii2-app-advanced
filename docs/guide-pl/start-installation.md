Instalacja
==========

## Wymagania

Minimalne wymagania tego szablonu projektu dla serwera to obsługa PHP 5.6.0.

## Instalacja za pomocą Composera

Jeśli nie posiadasz zainstalowanego [Composera](https://getcomposer.org/), zapoznaj się najpierw z rozdziałem Przewodnika 
[Instalacja Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide-pl/start-installation.md#installing-via-composer).

Po zainstalowaniu Composera możesz zainstalować aplikację korzystając z poniższych komend:

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

Komenda instaluje zaawansowaną aplikację w folderze o nazwie `yii-application`. Możesz, rzecz jasna, wybrać 
dowolną inną nazwę.

## Instalacja z pliku archiwum

Wypakuj plik archiwum pobrany ze strony [yiiframework.com](https://www.yiiframework.com/download/) do folderu `advanced`, 
znajdującego się bezpośrednio w głównym folderze serwera Web.

Następnie przejdź do instrukcji w sekcji poniżej.


## Przygotowanie aplikacji

Po zainstalowaniu aplikacji konieczne jest wykonanie poniższych kroków, aby ją poprawnie zainicjalizować. Należy to 
zrobić raz na każdym nowym środowisku.

1. Otwórz terminal konsoli, uruchom komendę `init` i wybierz `dev` dla środowiska deweloperskiego (lub `prod` dla produkcyjnego).

   ```
   /path/to/php-bin/php /path/to/yii-application/init
   ```

   W przypadku zautomatyzowanego procesu z użyciem skryptu, możesz uruchomić `init` w trybie nieinteraktywnym.

   ```
   /path/to/php-bin/php /path/to/yii-application/init --env=Production --overwrite=All --delete=All
   ```

2. Stwórz nową bazę danych i zmodyfikuj odpowiednio jej dane w kluczu `components['db']` w pliku `common/config/main-local.php`.

3. Uruchom migrację w terminalu konsoli za pomocą komendy `/path/to/php-bin/php /path/to/yii-application/yii migrate`.

4. Ustaw docelowe foldery serwera Web:

   - dla front-endu `/path/to/yii-application/frontend/web/` z użyciem adresu URL `http://frontend.test/`
   - dla back-endu `/path/to/yii-application/backend/web/` z użyciem adresu URL `http://backend.test/`

   W przypadku serwera Apache konfiguracja może wyglądać następująco:

   ```apache
       <VirtualHost *:80>
           ServerName frontend.test
           DocumentRoot "/path/to/yii-application/frontend/web/"
           
           <Directory "/path/to/yii-application/frontend/web/">
               # uruchom mod_rewrite dla obslugi 'ladnych' adresow URL
               RewriteEngine on
               # jesli folder lub plik istnieje, po prostu wywolaj go
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # w pozostalych przypadkach przekieruj na index.php
               RewriteRule . index.php

               # ustaw index.php jako plik indeksowy
               DirectoryIndex index.php

               # ...pozostale ustawienia...
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
               # uruchom mod_rewrite dla obslugi 'ladnych' adresow URL
               RewriteEngine on
               # jesli folder lub plik istnieje, po prostu wywolaj go
               RewriteCond %{REQUEST_FILENAME} !-f
               RewriteCond %{REQUEST_FILENAME} !-d
               # w pozostalych przypadkach przekieruj na index.php
               RewriteRule . index.php

               # ustaw index.php jako plik indeksowy
               DirectoryIndex index.php

               # ...pozostale ustawienia...
               # Apache 2.4
               Require all granted
               
               ## Apache 2.2
               # Order allow,deny
               # Allow from all
           </Directory>
       </VirtualHost>
   ```

   W przypadku serwera nginx:

   ```nginx
       server {
           charset utf-8;
           client_max_body_size 128M;

           listen 80; ## nasluchuj dla ipv4
           #listen [::]:80 default_server ipv6only=on; ## nasluchuj dla ipv6

           server_name frontend.test;
           root        /path/to/yii-application/frontend/web/;
           index       index.php;

           access_log  /path/to/yii-application/log/frontend-access.log;
           error_log   /path/to/yii-application/log/frontend-error.log;

           location / {
               # przekieruj wszystko, co nie jest rzeczywistym plikiem, na index.php
               try_files $uri $uri/ /index.php$is_args$args;
           }

           # odkomentuj ponizsze, aby uniknac przetwarzania wywolan nieistniejacych statycznych plikow przez Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           # zablokuj wywolywanie plikow php w folderze /assets
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
       
           listen 80; ## nasluchuj dla ipv4
           #listen [::]:80 default_server ipv6only=on; ## nasluchuj dla ipv6
       
           server_name backend.test;
           root        /path/to/yii-application/backend/web/;
           index       index.php;
       
           access_log  /path/to/yii-application/log/backend-access.log;
           error_log   /path/to/yii-application/log/backend-error.log;
       
           location / {
               # przekieruj wszystko, co nie jest rzeczywistym plikiem, na index.php
               try_files $uri $uri/ /index.php$is_args$args;
           }
       
           # odkomentuj ponizsze, aby uniknac przetwarzania wywolan nieistniejacych statycznych plikow przez Yii
           #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
           #    try_files $uri =404;
           #}
           #error_page 404 /404.html;

           # zablokuj wywolywanie plikow php w folderze /assets
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

5. Zmodyfikuj plik hostów, aby wskazać domenę na serwerze.

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   Dodaj poniżesz linie:

   ```
   127.0.0.1   frontend.test
   127.0.0.1   backend.test
   ```

Aby zalogować się do aplikacji, najpierw musisz się zarejestrować używając dowolnego adresu email, nazwy użytkwnika 
i hasła. Po udanej rejestracji możesz się zalogować używając podanych danych.


> Note: jeśli chcesz używać zaawansowanego szablonu w pojedynczej domenie (gdzie `/` wskazuje na front-end, a `/admin` 
> na back-end), zapoznaj się z rozdziałem 
> [Korzystanie z zaawansowanego szablonu projektu w środowisku współdzielonym](topic-shared-hosting.md).

## Instalacja przy użyciu Vagrant

Poniższy sposób jest najłatwiejszy, ale za to długi (ok. 20 minut).

**Ten sposób nie wymaga instalowania odpowiedniego oprogramowania (tj. serwera Web, PHP, MySQL itp.)** - po prostu 
wykonuj kolejne kroki!

#### Instrukcje dla użytkowników Linux/Unix

1. Zainstaluj [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Zainstaluj [Vagrant](https://www.vagrantup.com/downloads.html)
3. Utwórz [osobisty token API](https://github.com/blog/1509-personal-api-tokens) w serwisie GitHub
4. Przygotuj projekt:
   
   ```bash
   git clone https://github.com/yiisoft/yii2-app-advanced.git
   cd yii2-app-advanced/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
5. Umieść swój osobisty token API GitHub w `vagrant-local.yml`
6. Zmień folder na główny folder projektu:

   ```bash
   cd yii2-app-advanced
   ```

7. Uruchom komendy:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
To wszystko. Teraz tylko musisz poczekać na zakończenie procesu! Po wszystkim możesz przejść do lokalnego projektu za 
pomocą adresów URL:
* front-end: http://y2aa-frontend.test
* back-end: http://y2aa-backend.test
   
#### Instrukcje dla użytkowników Windows

1. Zainstaluj [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Zainstaluj [Vagrant](https://www.vagrantup.com/downloads.html)
3. Zrestartuj system
4. Utwórz [osobisty token API](https://github.com/blog/1509-personal-api-tokens) w serwisie GitHub
5. Przygotuj projekt:
   * pobierz repozytorium [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced/archive/master.zip)
   * rozpakuj je
   * przejdź do folderu `yii2-app-advanced-master/vagrant/config`
   * skopiuj zawartość pliku `vagrant-local.example.yml` do `vagrant-local.yml`

6. Umieść swój osobisty token API GitHub w `vagrant-local.yml`
7. Dodaj poniższe linie do [pliku hostów](https://en.wikipedia.org/wiki/Hosts_(file)):
   
   ```
   192.168.83.137 y2aa-frontend.test
   192.168.83.137 y2aa-backend.test
   ```

8. Otwórz terminal (`cmd.exe`), **zmień folder na folder główny projektu** i uruchom komendy:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
   (Przeczytaj [tutaj](https://www.wikihow.com/Change-Directories-in-Command-Prompt), w jaki sposób zmienić foldery w terminalu konsoli) 

To wszystko. Teraz tylko musisz poczekać na zakończenie procesu! Po wszystkim możesz przejść do lokalnego projektu za 
pomocą adresów URL:
* front-end: http://y2aa-frontend.test
* back-end: http://y2aa-backend.test
