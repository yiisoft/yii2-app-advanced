Uruchamianie testów
===================

Zaawansowana aplikacji Yii 2 korzysta z Codeception jako głównego frameworka testowego. 
Kilka przygotowanych przykładowych testów można znaleźć w folderze `tests` w `frontend`, `backend` i `common`.
Poniżej opisana procedura zakłada, że aplikacja została zainicjowana dla środowiska `dev`. W przypadku testowania 
środowiska `Production` należy ręcznie skopiować pliki `yii_test` i `yii_test.bat` z folderu `environments/dev` do 
głównego folderu projektu.
Proces testowania wymaga **dodatkowej bazy danych**, która będzie czyszczona pomiędzy poszczególnymi testami.
Stwórz bazę danych MySQL o nazwie `yii2advanced_test` (zgodnie z konfigurację pliku `common/config/test.php`) i uruchom: 

```
./yii_test migrate
```

Zbuduj pakiet testowy:

```
vendor/bin/codecept build
```

Teraz wszystkie przykładowe testy można uruchomić za pomocą:

```
vendor/bin/codecept run
```

Rezultat będzie podobny do poniższego:

![](images/tests.png)

Zalecane jest ciągłe aktualizowanie swoich testów. W przypadku, gdy klasa lub funkcjonalność jest usuwana, odpowiadające 
jej testy również powinny być skasowane.  
Testy powinno się przeprowadzać regularnie, a najlepiej jest przygotować do tego celu serwer Ciągłej Integracji.  

Przeczytaj artykuł [Yii 2 Framework Case Study](http://codeception.com/for/yii), aby zapoznać się z konfiguracją 
Codeception dla swojej aplikacji.

### Część Common

Testy dla klas folderu common umieszczone są w `common/tests`. W tym szablonie przygotowane zostały jedynie testy 
`jednostkowe`.  
Uruchomisz je za pomocą:

```
vendor/bin/codecept run -- -c common
```

Opcja `-c` pozwala na ustawienie ścieżki do pliku konfiguracyjnego `codeception.yml`.

Testy `jednostkowe` pakietu (umieszczone w `common/tests/unit`) mogą korzystać z funkcjonalności frameworka Yii: 
`Yii::$app`, Active Record, fixtures, itp. Jest to możliwe dzięki modułowi `Yii2` dodanemu w konfiguracji 
`common/tests/unit.suite.yml` (moduł można wyłączyć, aby przeprowadzać testy w izolacji od głównego frameworka). 


### Część Frontend

Pakiet testowy części Frontend składa się z testów jednostkowych, funkcjonalnych i akceptacyjnych.  
Uruchomisz je za pomocą:

```
vendor/bin/codecept run -- -c frontend
```

Opis poszczególnych pakietów:

* `unit` ⇒ klasy związane jedynie z aplikacją front-end.
* `functional` ⇒ wewnętrzne żądania i odpowiedzi aplikacji (bez serwera web).
* `acceptance` ⇒ aplikacja web, interfejs użytkownika i interakcje z użyciem JavaScript w prawdziwej przeglądarce.

Domyślnie testy akceptacyjne są wyłączone. Poniżej znajdziesz instrukcję ich uruchamiania:

#### Uruchamianie testów akceptacyjnych

Aby przeprowadzić testy akceptacyjne, wykonaj następujące kroki:  

1. Zmień nazwę pliku `frontend/tests/acceptance.suite.yml.example` na `frontend/tests/acceptance.suite.yml`, aby włączyć konfigurację pakietu

2. Zamień pakiet `codeception/base` w pliku `composer.json` na `codeception/codeception`, aby zainstalować pełną wersję Codeception

3. Zaktualizuj zależności używając Composera 

    ```
    composer update  
    ```

4. Wygeneruj automatycznie nowe pomocnicze klasy dla testów akceptacyjnych:

    ```
    vendor/bin/codecept build -- -c frontend
    ```

5. Pobierz [Serwer Selenium](http://www.seleniumhq.org/download/) i uruchom go:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

6. Uruchom serwer web:

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

7. Teraz już możesz uruchomić wszystkie dostępne testy

   ```
   vendor/bin/codecept run acceptance -- -c frontend
   ```

## Część Backend

Aplikacja back-end zawiera testy jednostkowe i funkcjonalne. Uruchomisz je za pomocą:

```
vendor/bin/codecept run -- -c backend
```
