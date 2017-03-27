Ajout d'applications supplémentaires
====================================

Tandis qu'avoir des interfaces utilisateur et d'administration séparées est une pratique courante, ce n'est parfois pas suffisant. Par exemple, vous pouvez avoir besoin d'une application additionnelle pour, disons, un blog. Pour l'avoir :

1. Copier le dossier `frontend` sur `blog`, `environments/dev/frontend` sur `environments/dev/blog` et `environments/prod/frontend`
sur `environments/prod/blog`.
2. Adapdez les espaces de noms et les chemins pour démarrer avec `blog` au lieu de `frontend`.
3. Dans `common\config\bootstrap.php` ajoutez `Yii::setAlias('blog', dirname(dirname(__DIR__)) . '/blog');`.
