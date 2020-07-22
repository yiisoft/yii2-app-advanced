Foldery
=======

Główny folder zawiera następujące podfoldery:

- `backend` - [aplikacja web back-end](structure-applications.md).
- `common` - [pliki wspólne dla wszystkich aplikacji](structure-applications.md).
- `console` - [aplikacja konsoli](structure-applications.md).
- `environments` - [konfiguracje środowisk](structure-environments.md).
- `frontend` - [aplikacja web front-end](structure-applications.md).

Folder główny zawiera zestaw plików.

- `.gitignore` zawiera listę folderów ignorowanych przez system wersjonowania git. Jeśli chcesz, aby coś nie zostało 
  zapisane w plikach źródłowych repozytorium, dodaj to w tym miejscu.
- `composer.json` - plik konfiguracyjny Composera opisany w rozdziale [Konfiguracja Composera](start-composer.md).
- `init` - skrypt inicjalizujący opisany w rozdziale [Konfiguracja i środowiska](structure-environments.md).
- `init.bat` - ten sam skrypt dla systemu Windows.
- `LICENSE.md` - informacje o licencji. Umieść tutaj licencję odpowiednią dla swojego projektu (zwłaszcza w przypadku projektu typu open-source).
- `README.md` - podstawowe informacje na temat instalowania szablonu. Pomyśl o zamienieniu ich na informacje dotyczące 
   swojego projektu i jego instalacji.
- `requirements.php` - test spełnienia wymagań Yii.
- `yii` - plik wejściowy aplikacji konsoli.
- `yii.bat` - ten sam plik dla systemu Windows.
