Korzystanie z zaawansowanego szablonu projektu w środowisku współdzielonym
==========================================================================

Wdrożenie zaawansowanego szablonu projektu w środowisku współdzielonym jest nieco bardziej skomplikowane niż w przypadku 
podstawowego szablonu, ponieważ zawiera on dwa foldery web (foldery, na które wskazuje adres serwisu), co nie jest 
wspierane przez serwery takich środowisk. Konieczna jest modyfikacja struktury folderów tak, aby adresem URL front-endu 
stał się `http://site.test`, a back-endu `http://site.test/admin`.

### Przenieś skrypty wejściowe do jednego folderu web

Przede wszystkim konieczny jest jeden folder web. Stwórz nowy folder i nazwij go tak, jak wymaga tego Twój hosting,
np. `www` lub też `public_html`, czy coś podobnego. Następnie stwórz poniższą strukturę folderów, gdzie `www` jest 
nazwą hostingowego folderu web, dodanego przed chwilą (zmień ją, jeśli Twój hosting wymaga innej):

```
www
    admin
backend
common
console
environments
frontend
...
```

`www` będzie naszym nowym folderem front-endowym, zatem przenieś do niego zawartość `frontend/web`. Zawartość folderu 
`backend/web` przenieś za to do `www/admin`. W obu przypadkach będziesz musiał poprawić ścieżki podane w `index.php` 
i `index-test.php`.

### Dopasuj ustawienia sesji i ciasteczek

Standardowo back-end i front-end stworzone zostały do pracy na różnych domenach. Po przeniesieniu ich do tej samej 
domeny, aplikacje będą współdzielić ciasteczka, co doprowadzi do konfliktu. Aby temu przeciwdziałać, zmodyfikuj konfigurację 
aplikacji back-end w pliku `backend/config/main.php` następująco:

```php
'components' => [
    'request' => [
        'csrfParam' => '_csrf-backend',
        'csrfCookie' => [
            'httpOnly' => true,
            'path' => '/admin',
        ],
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_identity-backend',
            'path' => '/admin',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        // to jest nazwa ciasteczka sesji używanego do logowania się na back-endzie
        'name' => 'advanced-backend',
        'cookieParams' => [
            'path' => '/admin',
        ],
    ],
],
```

### Alternatywne ustawienia

Jeśli podany tutaj sposób nie działa na Twoim serwerze, wypróbuj 
[instrukcję, którą stworzył Oleg Belostotskiy](https://github.com/mickgeek/yii2-advanced-one-domain-config).
