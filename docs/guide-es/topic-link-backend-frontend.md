Creando enlaces desde el backend al fronted
===========================================

Frecuentemente se necesita crear enlaces de la aplicación backend a la aplicación frontend. Dado que la aplicación frontend puede contener sus propias
reglas del gestor de URL puedes necesitar duplicarlo para la aplicación backend nombrandolo diferente:

```php
return [
    'components' => [
        'urlManager' => [
            // here is your normal backend url manager config
        ],
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
        ],

    ],
];
```

Una vez hecho, puedes coger una URL apuntando al frontend de la siguiente manera:

```php
echo Yii::$app->urlManagerFrontend->createUrl(...);
```
