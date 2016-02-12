Añadiendo más aplicaciones
==========================

si bien tener separado frontend y backend es común, algunas veces no es suficiente. Por ejemplo puedes necesitar una aplicación
adicional para, digamos, un blog. En el orden de hacerlo:

1. Copia `frontend` a `blog`, `environments/dev/frontend` a `environments/dev/blog` y `environments/prod/frontend`
a `environments/prod/blog`.
2. Ajusta los namespaces y rutas para comenzar en `blog`en vez de `frontend`.
3. En `common\config\bootstrap.php`añade `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
