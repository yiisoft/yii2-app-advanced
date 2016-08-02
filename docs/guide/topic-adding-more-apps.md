Adding more applications
========================

While having separate frontend and backend is common, sometimes it's not enough. For example, you may need additional
application for, say, a blog. In order to get it:

1. Copy `frontend` to `blog`, `environments/dev/frontend` to `environments/dev/blog` and `environments/prod/frontend`
to `environments/prod/blog`.
2. Adjust namespaces and paths to start with `blog` instead of `frontend`.
3. In `common\config\bootstrap.php` add `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
