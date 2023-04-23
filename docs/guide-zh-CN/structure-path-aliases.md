预定义路径别名
=======================

- `@yii` - 框架目录。
- `@app` - 当前运行的应用程序的基本路径。
- `@common` - 公共目录。
- `@frontend` - 前端Web应用程序目录。
- `@backend` - 后端Web应用程序目录。
- `@console` - 控制台目录。
- `@runtime` - 当前正在运行的Web应用程序的runtime目录。
- `@vendor` - Composer vendor 目录.
- `@bower` - vendor 目录下的 [bower packages](https://bower.io/).
- `@npm` - vendor 目录下的 [npm packages](https://www.npmjs.org/).
- `@web` - 当前运行的Web应用程序的 base URL。
- `@webroot` - 当前运行的Web应用程序的web根目录。

特定于高级应用程序的目录结构的别名
(`@common`,  `@frontend`, `@backend`, 以及 `@console`) 在 `common/config/bootstrap.php` 文件中定义.