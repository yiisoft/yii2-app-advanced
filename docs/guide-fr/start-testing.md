Tests
===============================

L'application avancée de Yii2 utilise Codeception en tant que structure de base de test primaire. Il existe déjà quelques échantillons de tests préparés dans le dossier `tests` des dossiers `frontend`, `backend` et `common`. Pour que la procédure suivante fonctionne, on suppose que l'application a été initialisée en utilisant l'environnement `dev`. Dans le cas où les tests doivent être exécutés dans l'environnement `production`, les fichiers `yii_test` et `yii_test.bat` doivent être copiés manuellement du dossier `environnements/dev` vers le dossier racine du projet. 
Les tests nécessitent une **base de données additionnelle**, qui sera vidée entre les tests. Créez une base de données `yii2advanced_test` avec mysql (en accord avec la configuration dans `common/config/test.php`) et exécutez : 

```
./yii_test migrate
```

Construisez la suite de tests :

```
vendor/bin/codecept build
```

Ensuit, tous les échantillons de test peuvent être lancés en exécutant :

```
vendor/bin/codecept run
```

La sortie devrait ressembler à ceci :

![](images/tests.png)

Il est recommandé de maintenir les tests à jour. Si une classe, ou une fonctionnalité, est effacée, les tests correspondant doivent l'être également.
Vous devriez exécuter les tests régulièrement, ou mieux, configurer l'intégration continue au serveur pour eux. 

Reportez-vous à  [Étude de cas Yii2 Framework](https://codeception.com/for/yii) pour savoir comment configurer Codeception pour votre application. 

### Common (communs)

Les tests pour les classes partagées sont situées dans `common/tests`. Dans ce modèle, il s'agit unitquement de tests unitaires (`unit`).
Lancez-les en exécutant : 
```
vendor/bin/codecept run -- -c common
```

L'option `-c` permet de définir le chemin vers la configuration `codeception.yml`.

La suite de tests unitaires (`unit`) (située dans `common/tests/unit`) peut utiliser les fonctionnalités de  Yii framework : `Yii::$app`, l'enregistrement actif (*ActiveRecord*), les environnement prédéfinis (*fixtures*), etc.
Cela est effectif parce que le module `Yii2` est activé dans la configuration des tests unitaires : `common/tests/unit.suite.yml`. Vous pouvez le désactiver pour exécuter les tests en isolation totale.


### Interface utilisateur (frontend)

Les tests de l'interface utilisateur contiennent des tests unitaires, fonctionnels et d'acceptation. 
Exécutez-les avec :
```
vendor/bin/codecept run -- -c frontend
```

Description des suites de tests :

* `unit` ⇒ classes relatives à l'application interface utilisateur seulement. 
* `functional` ⇒ requêtes/réponses internes de l'application (sans serveur web).
* `acceptance` ⇒ application web, interface utilisateur et interactions  javascript dans le navigateur réel.

Les tests d'acceptation sont désactivés par défaut. Pour les utiliser exécutez ce qui suit.

#### Exécutiton des tests d'acceptation

Pour exécuter les tests d'acceptation suivez les étapes ci-dessous : 

1. Renommez `frontend/tests/acceptance.suite.yml.example` en `frontend/tests/acceptance.suite.yml` pour activer la configuration de la suite

1. Remplacez le paquet `codeception/base` dans `composer.json` par `codeception/codeception` pour installer une version complète de Codeception

1. Mettez les dépendances à jour avec Composer 

    ```
    composer update  
    ```

1. Auto-générez les nouvelles classes pour la prise en charge des tests d'acceptation :

    ```
    vendor/bin/codecept build -- -c frontend
    ```

1. Téléchargez [Selenium Server](https://www.seleniumhq.org/download/) et lancez-le :

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

1. Démarrez le serveur Web :

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

1. Maintenant, vous pouvez exécuter tous les tests disponibles :

   ```
   vendor/bin/codecept run acceptance -- -c frontend
   ```

## Interface d'administration (backend)

L'application *interface d'administration* contient les suites de tests unitaires et fonctionnels. Exécutez-les avec  :

```
vendor/bin/codecept run -- -c backend
```
