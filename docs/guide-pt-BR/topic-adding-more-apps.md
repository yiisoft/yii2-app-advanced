Adicionando mais aplicações
===========================

Enquanto a separação entre frontend e backend é comum, a mesma pode não ser o suficiente dependendo da situação.
Você pode necessitar de uma aplicação adicional, por exemplo, um blog. A fim de obtê-lo:

1. Copie `frontend` para `blog`, `environments/dev/frontend` para `environments/dev/blog` e `environments/prod/frontend`
para `environments/prod/blog`.
2. Ajuste os namespaces e caminhos para iniciarem com `blog` ao invés de `frontend`.
3. Em `common\config\bootstrap.php` adicione `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.