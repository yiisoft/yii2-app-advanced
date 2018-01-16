在虚拟主机上使用高级项目模板
==================================

将高级项目模板部署到虚拟主机，相比基本项目模版来说有点棘手，因为它有两个webroots，共享托管网络服务器不支持。 我们需要调整目录结构，然后前端的 URL 是 `http://site.test` 而后端的 URL 是 `http://site.test/admin` . 

### 将入口文件移动到单个webroot

首先我们需要一个webroot目录。 创建一个新目录并将其命名为与托管webroot名称匹配，例如 `www` 或 `public_html` 等. 然后创建以下结构，其中 `www` 是您刚刚创建的托管webroot目录：

```
www
    admin
backend
common
console
environments
frontend
...
```

`www` 将是我们的前端目录，所以将 `frontend/web` 的内容移动到其中。 将 `backend/web` 的内容移动到 `www/admin`。 在每种情况下，您都需要调整 “index.php” 和 “index-test.php” 中的路径。

### 调整 sessions 和 cookies 的配置

最初，后端和前端旨在运行在不同的域。 当我们将其全部移动到同一个域时，前端和后端将共享相同的Cookie，从而产生冲突。 为了解决它，请调整后端应用程序配置 `backend/config/main.php` 如下：

```php
'components' => [
    'request' => [
        'csrfParam' => '_csrf-backend',
        'csrfCookie' => [
            'httpOnly' => true,
            'path' => '/admin',
        ],
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_identity-backend',
            'path' => '/admin',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        // this is the name of the session cookie used for login on the backend
        'name' => 'advanced-backend',
        'cookieParams' => [
            'path' => '/admin',
        ],
    ],
],
```

### 自行配置

如果上面提供的设置模板的方式不适合你，请尝试
[configs and docs by Oleg Belostotskiy](https://github.com/mickgeek/yii2-advanced-one-domain-config).
