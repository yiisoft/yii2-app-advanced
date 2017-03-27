Création de liens de l'interface d'administration vers l'interface utilisateur
==============================================================================

Souvent, il est nécessaire de créer des liens depuis l'application interface d'administration vers l'application l'interface utilisateur. Comme l'interface utilisateur peut contenir ses propres règles de gestionnaire d'URL, vous devez les dupliquer pour l'interface d'administration en les nommant différemment :

```php
return [
    'components' => [
        'urlManager' => [
            // ici se trouve votre configuration normale du gestionnaire d'URL de l'interface d'administration
        ],
        'urlManagerFrontend' => [
            // ici se trouve votre configuration du gestionnaire d'URL de l'interface utilisateur
        ],

    ],
];
```

Après l'avoir fait, vous pouvez obtenir une URL qui pointe sur l'interface utilisateur comme ceci :

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

Afin de ne pas copier-coller les règles de l'interface utilisateur, vous pouvez d'abord les déplacer dans un fichier `urls.php` :

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require 'urls.php',
        ],
        // ...

    ],
    // ...
];
```

Ensuite vous pouvez l'inclure dans les règles `urlManagerFrontend` également.
