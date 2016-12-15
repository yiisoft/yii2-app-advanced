配置和环境
==============================

典型的配置方法有多个问题：

- 每个团队成员都有自己的配置选项。 提交此配置将影响其他团队成员。
- 生产数据库密码和API密钥不应该存储在存代码库中。
- 有多个服务器环境：开发，测试，生产。 每个应该有自己的配置。
- 为每种情况定义所有配置选项非常重复，需要花费太多时间来维护。

为了解决这些问题，Yii介绍了一个简单的环境概念。 每个环境由 `environments` 目录下的一组文件表示。  `init` 命令用于初始化一个环境。 它真正做的是将所有内容从环境目录复制到所有应用程序所在的根目录。

默认情况下有两个环境： `dev` 和 `prod` 。 第一个是开发环境。 默认打开所有开发调试工具。 第二个是生产环境。 默认关闭调试和开发工具。

通常环境包含应用程序引导文件，如 `index.php` 和配置文件后缀 `-local.php` 。 这些是通常在 `dev` 环境中的团队成员的个人配置或特定服务器的配置。 例如，生产数据库连接可以在 `prod` 环境 `-local.php` 配置中。 这些本地配置被添加到 `.gitignore` ，从不推送到源代码仓库。

为了避免重复配置彼此覆盖。 例如，前端读取配置以如下顺序：

- `common/config/main.php`
- `common/config/main-local.php`
- `frontend/config/main.php`
- `frontend/config/main-local.php`

参数按以下顺序读取：

- `common/config/params.php`
- `common/config/params-local.php`
- `frontend/config/params.php`
- `frontend/config/params-local.php`

后面的配置文件覆盖前者。

这里是完整的流程：

![Advanced application configs](images/advanced-app-configs.png)
