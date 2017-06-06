Tworzenie linków pomiędzy back-endem i front-endem
==================================================

Często spotykanym wymaganiem jest utworzenie linków pomiędzy aplikacją back-endową a front-endową. Ponieważ front-end 
może posiadać oddzielny komponent menadżera adresów URL, musisz skopiować jego ustawienia (pod inną nazwą):

```php
return [
    'components' => [
        'urlManager' => [
            // w tym miejscu podaj konfigurację menadżera URL dla aplikacji back-end
        ],
        'urlManagerFrontend' => [
            // a tutaj konfigurację menadżera URL dla front-end
        ],

    ],
];
```

Od tej pory możesz podać adres URL wskazujący na front-end w poniższy sposób:

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

Aby nie podawać podwójnie front-endowych zasad menadżera, możesz umieścić je w osobnym pliku `urls.php`:

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

Dzięki temu wystarczy, że dołączysz go również w konfiguracji `urlManagerFrontend`.
