安装
===

## 要求

此项目模板的最低要求是您的Web服务器支持PHP 5.6.0。

## 使用Composer安装

如果您没有 [Composer](http://getcomposer.org/)，请按照最终指南的
[安装Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide/start-installation.md#installing-via-composer) 部分中的说明进行安装。

安装Composer后，您可以使用以下命令安装应用程序：

    composer create-project --prefer-dist yiisoft/yii2-app-advanced yii-application

个命令将高级应用程序安装在名为 `yii-application` 的目录中。 如果需要，您可以选择不同的目录名称。 

## 从归档文件安装

将从 [yiiframework.com](http://www.yiiframework.com/download/) 下载的归档文件解压缩到直接位于Web根目录下的名为advanced的目录。

然后按照下一小节中给出的说明进行操作。


## 准备应用程序

安装应用程序后，必须执行以下步骤来初始化已安装的应用程序。 这些操作仅需执行一次即可。

1. 打开控制台终端，执行 `init` 命令并选择 `dev` 作为环境。

   ```
   /path/to/php-bin/php /path/to/yii-application/init
   ```

   如果使用脚本自动化，可以在非交互模式下执行 `init` 。

   ```
   /path/to/php-bin/php /path/to/yii-application/init --env=Production --overwrite=All
   ```

2. 创建一个新的数据库，并相应地调整 `common/config/main-local.php` 中的 `components['db']` 配置。

3. 打开控制台终端，执行迁移命令 `/path/to/php-bin/php /path/to/yii-application/yii migrate`.

4. 设置Web服务器的文档根目录：

   - 对于前端 `/path/to/yii-application/frontend/web/` 并且使用URL `http://frontend.test/`
   - 对于后端 `/path/to/yii-application/backend/web/` 并且使用URL `http://backend.test/`

   对于Apache，使用如下配置：

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

   nginx使用如下配置：

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

5. 更改主机文件以将域指向您的服务器。

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   添加以下行：

   ```
   127.0.0.1   frontend.test
   127.0.0.1   backend.test
   ```

要登录应用程序，您需要先注册您的电子邮件地址，用户名和密码。
然后，您可以随时使用相同的电子邮件地址和密码登录应用程序。


> 注意：如果要在单个域上运行高级模板，则 `/` 是前端，而 `/admin` 是后端，请参阅[在共享主机上使用高级项目模板](topic-shared-hosting.md)。

## 使用Vagrant安装

这是最简单的安装方式，但是耗时较长（约20分钟）。

**这种安装方式不需要预先安装的软件（如Web服务器，PHP，MySQL等）** - 只是做下一步！

#### Linux/Unix 用户手册

1. 安装 [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. 安装 [Vagrant](https://www.vagrantup.com/downloads.html)
3. 创建 GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens)
3. 准备项目:
   
   ```bash
   git clone https://github.com/yiisoft/yii2-app-advanced.git
   cd yii2-app-advanced/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. 将您的GitHub个人API令牌放置到 `vagrant-local.yml`
5. 将目录更改为项目根目录：

   ```bash
   cd yii2-app-advanced
   ```

5. 执行如下命令：

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
等待完成后，在浏览器中访问如下URL即可

* frontend: http://y2aa-frontend.test
* backend: http://y2aa-backend.test
   
#### Windows 用户手册

1. 安装 [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. 安装 [Vagrant](https://www.vagrantup.com/downloads.html)
3. 重启电脑
4. 创建 GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens)
5. 准备项目:
   * 下载 [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced/archive/master.zip)
   * 解压
   * 进入 `yii2-app-advanced-master/vagrant/config` 文件夹
   * 重命名 `vagrant-local.example.yml` 为 `vagrant-local.yml`

6. 将您的GitHub个人API令牌放置到 `vagrant-local.yml`
7. 添加如下代码到 [hosts 文件](https://en.wikipedia.org/wiki/Hosts_(file)):
   
   ```
   192.168.83.137 y2aa-frontend.test
   192.168.83.137 y2aa-backend.test
   ```

8. 打开终端 (`cmd.exe`), **切换路径至项目根目录** 并且执行如下命令:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ```
   
   (猛击 [这里](http://www.wikihow.com/Change-Directories-in-Command-Prompt) 查看如何在命令提示符中更改目录) 

等待完成后，在浏览器中访问如下URL即可

* frontend: http://y2aa-frontend.test
* backend: http://y2aa-backend.test

