测试
===============================

Yii2高级应用程序使用Codeception作为其主要测试框架。
已经在 `frontend` ， `backend` 和 `common` 的 `tests` 目录中准备了一些样本测试。
为了使以下过程工作，假定应用程序已使用初始化 `dev` 环境。 如果测试需要在 `Production` 环境中执行， `yii_test` 和 `yii_test.bat` 必须从 `environments/dev` 文件夹手动复制到项目根目录。
测试需要一个 **额外的数据库** ，这将在测试之间清除。
在mysql中创建数据库 `yii2advanced_test` （根据 `common/config/test.php` 中的配置）并执行：

```
./yii_test migrate
```

构建测试套件：

```
vendor/bin/codecept build
```

然后所有的样例测试可以通过运行如下代码：

```
vendor/bin/codecept run
```

您将看到类似于以下的输出：

![](images/tests.png)

建议保持测试最新。 如果一个类或功能被删除，相应的测试也应该被删除。
您应定期运行测试，或更好地为它们设置持续集成服务器。

请参考 [Yii2 Framework Case Study](https://codeception.com/for/yii) ，了解如何为应用程序配置代码。
### Common

common部分的测试位于 `common/tests`. 在这个模板中只有 `unit` （单元）测试。
运行如下代码:

```
vendor/bin/codecept run -- -c common
```

`-c` 选项允许设置 `codeception.yml` 配置的路径。

在 `unit` 测试套件（位于 `common/tests/unit` ）中的测试可以使用Yii框架特性：`Yii::$app`，Active Record，fixtures等。
这是因为 `Yii2` 模块在单元测试config：`common/tests/unit.suite.yml` 中被启用。 您可以禁用它以完全隔离的方式运行测试。


### Frontend

前端测试包含单元测试，功能测试和验收测试。
通过运行：

```
vendor/bin/codecept run -- -c frontend
```

测试套件描述：

* `unit` ⇒ 仅与前端应用程序相关的类。
* `functional` ⇒ 应用程序内部请求/响应（无Web服务器）。
* `acceptance` ⇒ web应用程序，用户界面和javascript交互。

默认情况下，验收测试被禁用，运行它们使用：

#### 运行验收测试

要执行验收测试，请执行以下操作： 

1. 重命名 `frontend/tests/acceptance.suite.yml.example` 为 `frontend/tests/acceptance.suite.yml` 以启用套件配置

1. 在 `composer.json` 中替换 `codeception/base` 包为 `codeception/codeception` 以安装Codeception的全部功能

1. 使用Composer更新依赖关系 

    ```
    composer update  
    ```

1. 为验收测试自动生成新的支持类:

    ```
    vendor/bin/codecept build -- -c frontend
    ```

1. 下载 [Selenium Server](https://www.seleniumhq.org/download/) 并启动:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

1. 启动web服务器:

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

1. 现在可以运行所有可用的测试

   ```
   vendor/bin/codecept run acceptance -- -c frontend
   ```

## Backend

后端应用程序包含单元和功能测试套件。 通过运行：

```
vendor/bin/codecept run -- -c backend
```
