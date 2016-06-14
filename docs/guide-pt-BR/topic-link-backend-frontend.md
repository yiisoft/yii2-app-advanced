Criando links do backend para o frontend
========================================

Frequentemente é necessário a criação de links da aplicação de backend para a aplicação de frontend. Uma vez que a
aplicação de frontend pode conter suas próprias regras do gerenciador de URL, você deve duplica-las para a aplicação
de backend nomeando o componente de forma diferente:

```php
return [
    'components' => [
        'urlManager' => [
            // configurações normais do gerenciador de URL do backend
        ],
        'urlManagerFrontend' => [
            // regras do gerenciador de URL provindas do frontend
        ],

    ],
];
```

Após a configuração, você pode criar uma URL apontando para o frontend da seguinte forma:

```php
echo Yii::$app->urlManagerFrontend->createUrl(...);
```

Para evitar copiar e colar as regras do seu frontend, você pode primeiro movê-las para um arquivo `urls.php` separado:

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

E depois incluí-las no componente `urlManagerFrontend` do backend também.