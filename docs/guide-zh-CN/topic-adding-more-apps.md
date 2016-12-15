添加更多应用程序
========================

虽然有单独的前端和后端是常见的，有时它是不够的。 例如，您可能需要额外的应用程序，例如博客。 使用如下方式创建：

1. 复制 `frontend` 至 `blog`, `environments/dev/frontend` 至 `environments/dev/blog` 以及 `environments/prod/frontend`
至 `environments/prod/blog`.
2. 调整命名空间和路径以 `blog` 开头（替换 `frontend`）.
3. 在 `common\config\bootstrap.php` 中添加 `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
