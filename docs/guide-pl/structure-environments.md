Konfiguracja i środowiska
=========================

Typowe podejście do konfigurowania projektu stawia przed deweloperami wiele problemów:

- Każdy programista w grupie ustala swoje własne opcje konfiguracyjne. Zapisywanie takiej konfiguracji może wpływać na resztę grupy.
- Hasła baz produkcyjnych i klucze API nie powinny znajdować się w repozytorium.
- Projekt wydawany jest zwykle na wielu środowiskach serwerowych: deweloperskim, testowym, produkcyjnym. Każde z nich powinno mieć oddzielną konfigurację.
- Ustalanie wszystkich opcji konfiguracyjnych dla każdego przypadku z osobna jest procesem żmudnym i wysoce powtarzalnym i zajmuje zbyt wiele czasu.

Yii, dzięki prostej koncepcji środowisk, zapewnia rozwiązanie powyższych problemów. Każde środowisko jest reprezentowane 
przez zestaw plików w folderze `environments`. Środowisko jest inicjalizowane za pomocą komendy `init`, która kopiuje 
wszystko z folderu środowiskowego do głównego folderu, w którym znajdują się aplikacje.

Domyślnie zdefiniowane są dwa środowiska: `dev` i `prod`. Pierwsze jest środowiskiem rozwojowym, skonfigurowanym 
z wszystkim narzędziami deweloperskimi i włączonym modułem debugowania. Drugie przeznaczone jest do wydania projektu 
na serwerze i powyższe opcje są tam wyłączone. 

Zwykle środowisko zawiera pliki skryptów wejściowych aplikacji jak np. `index.php` oraz pliki konfiguracyjne 
z przyrostkiem `-local.php`, które przechowują osobiste ustawienia programistów (zazwyczaj dla środowiska `dev`) lub też 
konkretne ustawienia serwerowe. Dla przykładu, połączenie do produkcyjnej bazy danych mogłoby znajdować się w pliku 
konfiguracyjnym `-local.php` środowiska `prod`.  
Takie lokalne konfiguracje są dodawane do pliku `.gitignore` i nie umieszczane nigdy w źródłowym repozytorium kodu.

Aby uniknąć duplikowania ustawień, pliki konfiguracyjne nadpisują się. Przykładowo, front-end odczytuje konfiguracje 
w następującej kolejności:

- `common/config/main.php`
- `common/config/main-local.php`
- `frontend/config/main.php`
- `frontend/config/main-local.php`

Parametry są odczytywane w takiej kolejności:

- `common/config/params.php`
- `common/config/params-local.php`
- `frontend/config/params.php`
- `frontend/config/params-local.php`

Kolejny plik konfiguracyjny nadpisuje poprzednika.

Poniżej przedstawiony jest pełny schemat:

![Advanced application configs](images/advanced-app-configs.png)
