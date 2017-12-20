Instalação
==========

## Pré-Requisitos

O requisito mínimo deste template de projetos é que seu servidor Web suporte PHP 5.4.0.

## Instalação utilizando Composer

Caso você não tenha o [Composer](http://getcomposer.org/) instalado, siga as instruções na seção [Instalando o Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide-pt-BR/start-installation.md#instalando-via-composer-)
do guia definitivo para Yii 2.0 para instala-lo.

Com o Composer instalado, você pode então instalar o template de projetos usando os seguintes comandos:

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application
    
O comando instala o template avançado de projetos no diretório `yii-application`.
Você pode escolher um diretório diferente se desejar.

## Instalação a partir de um arquivo

Descompacte o arquivo baixado de [yiiframework.com](http://www.yiiframework.com/download/) para 
um diretório com nome de `advanced` no diretório raiz do servidor Web.

Então siga as instruções presentes na próxima subseção.


## Preparando a aplicação

Após instalar o template avançado de projetos, você deve seguir os seguintes passos 
para inicializar a aplicação, sendo necessário realizá-los apenas uma vez no momento da instalação.

1. Abra um terminal de console, execute comando `init` e selecione a opção `dev`.

   ```
   /caminho/para/binario-php/php /caminho/para/aplicacao-yii/init
   ```
   
   Caso queria realizar a automação do processo por meio de um script, você pode executar o comando `init` em modo não interativo.
   
   ```
   /caminho/para/binario-php/php /caminho/para/aplicacao-yii/init --env=Production --overwrite=All
   ```
   
2. Crie um novo banco de dados e ajuste a configuração `components['db']` em `common/config/main-local.php` adequadamente.

3. Abra um terminal de console e aplique as migrações de dados utilizando o comando `/caminho/para/binario-php/php /caminho/para/aplicacao-yii/yii migrate`.

4. Configure a raiz dos documentos do seu servidor Web:
    
    - para o frontend `/caminho/para/aplicacao-yii/frontend/web/` usando URL `http://frontend.test/`
    - para o backend `/caminho/para/aplicacao-yii/backend/web/` usando URL `http://backend.test/`
    
    
    Exemplo de configuração para servidores Apache
    
    ```apache
           <VirtualHost *:80>
               ServerName frontend.test
               DocumentRoot "/caminho/para/aplicacao-yii/frontend/web/"
               
               <Directory "/caminho/para/aplicacao-yii/frontend/web/">
                   # Utilize o mod_rewrite para suporte a URL amigável
                   RewriteEngine on
                   # Se um diretório ou arquivo existe, usa a requisição diretamente
                   RewriteCond %{REQUEST_FILENAME} !-f
                   RewriteCond %{REQUEST_FILENAME} !-d
                   # Caso contrário, encaminha a requisição para index.php
                   RewriteRule . index.php
    
                   # usar index.php com arquivo index
                   DirectoryIndex index.php
    
                   # ...outras configurações...
               </Directory>
           </VirtualHost>
           
           <VirtualHost *:80>
               ServerName backend.test
               DocumentRoot "/caminho/para/aplicacao-yii/backend/web/"
               
               <Directory "/caminho/para/aplicacao-yii/backend/web/">
                   # Utilize o mod_rewrite para suporte a URL amigável
                   RewriteEngine on
                   # Se um diretório ou arquivo existe, usa a requisição diretamente
                   RewriteCond %{REQUEST_FILENAME} !-f
                   RewriteCond %{REQUEST_FILENAME} !-d
                   # Caso contrário, encaminha a requisição para index.php
                   RewriteRule . index.php
    
                   # usar index.php com arquivo index
                   DirectoryIndex index.php
    
                   # ...outras configurações...
               </Directory>
           </VirtualHost>
    ```
       
    Exemplo de configuração para servidores nginx:
    
    ```nginx
           server {
               charset utf-8;
               client_max_body_size 128M;
           
               listen 80; ## listen for ipv4
               #listen [::]:80 default_server ipv6only=on; ## listen for ipv6
           
               server_name frontend.test;
               root        /caminho/para/aplicacao-yii/frontend/web/;
               index       index.php;
           
               access_log  /caminho/para/aplicacao-yii/log/frontend-access.log;
               error_log   /caminho/para/aplicacao-yii/log/frontend-error.log;
           
               location / {
                   # Redireciona tudo que não é um arquivo real para index.php
                   try_files $uri $uri/ /index.php$is_args$args;
               }
           
               # descomente para evitar o processamento de chamadas a arquivos estáticos não existentes pelo Yii
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
               root        /caminho/para/aplicacao-yii/backend/web/;
               index       index.php;
           
               access_log  /caminho/para/aplicacao-yii/log/backend-access.log;
               error_log   /caminho/para/aplicacao-yii/log/backend-error.log;
           
               location / {
                   # Redireciona tudo que não é um arquivo real para index.php
                   try_files $uri $uri/ /index.php$is_args$args;
               }
           
               # descomente para evitar o processamento de chamadas a arquivos estáticos não existentes pelo Yii
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
    
5. Altere o arquivo de hosts para apontar o domínio do seu servidor.

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`
   
   Adicione as seguintes linhas:
   
   ```
   127.0.0.1   frontend.test
   127.0.0.1   backend.test
   ```
   
Para se autenticar na aplicação é necessário que primeiro, você se registre com qualquer um dos seus endereços de e-mail, usuário e senha.
Então, você pode se autenticar na aplicação com o mesmo endereço de e-mail e senha a qualquer momento.

> PS: caso queira que o template avançado de projetos utilize um único domínio, sendo `/` o frontend e `/admin` o backend, 
> consulte as [configurações e documentações por Oleg Belostotskiy](https://github.com/mickgeek/yii2-advanced-one-domain-config) (apenas inglês).

## Instalação utilizando Vagrant

Esta é a forma mais simples porém, mais demorada (~20 min).

**Esta forma de instalação não necessita de nenhum software pré-instalado (web-server, PHP, MySQL, etc.)** - basta apenas seguir as etapas!

#### Manual para usuários Linux/Unix

1. Instale o [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Instale o [Vagrant](https://www.vagrantup.com/downloads.html)
3. Crie um [token de API pessoal](https://github.com/blog/1509-personal-api-tokens) do GitHub
4. Prepare o projeto:
   
   ```bash
   git clone https://github.com/yiisoft/yii2-app-advanced.git
   cd yii2-app-advanced/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. Introduza seu token de API pessoal no arquivo `vagrant-local.yml`
5. Entre no diretório raiz do projeto:

   ```bash
   cd yii2-app-advanced
   ```

5. Execute os comandos:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
Isso é tudo. Basta aguardar a conclusão! Após isso você pode acessar o projeto localmente pelas URLs:
* frontend: http://y2aa-frontend.test
* backend: http://y2aa-backend.test

#### Manual para usuários Windows

1. Instale o [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Instale o [Vagrant](https://www.vagrantup.com/downloads.html)
3. Reinicie
4. Crie um [token de API pessoal](https://github.com/blog/1509-personal-api-tokens) do GitHub
5. Prepare o projeto:
   * faça do download do repositório [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced/archive/master.zip)
   * descompacte o arquivo
   * entre no diretório `yii2-app-advanced-master/vagrant/config`
   * copie o arquivo `vagrant-local.example.yml` para `vagrant-local.yml`
   
6. Introduza seu token de API pessoal no arquivo `vagrant-local.yml`
7. Adicione as seguintes linhas no [arquivo de hosts](https://pt.wikipedia.org/wiki/Hosts_(arquivo)):
   
   ```
   192.168.83.137 y2aa-frontend.test
   192.168.83.137 y2aa-backend.test
   ```
   
8. Abra o terminal (`cmd.exe`), **entre no diretório raiz do projeto** e execute os comandos:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
   (Você pode ler [aqui](http://pt.wikihow.com/Alterar-Diret%C3%B3rios-no-Prompt-de-Comandos) como alterar diretórios no prompt de comando) 

Isso é tudo. Basta aguardar a conclusão! Após isso você pode acessar o projeto localmente pelas URLs:
* frontend: http://y2aa-frontend.test
* backend: http://y2aa-backend.test

