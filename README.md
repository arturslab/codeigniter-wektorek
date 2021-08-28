# wektorek

## Opis skrócony
CMS zbudowany w oparciu o framework CodeIgniter (w wersji 3.1.11). Posiada rozszerzenie HMVC (więcej na https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/src/codeigniter-3.x/) zapewniającą lepszą organizację struktury plików, dzieląc je na moduły.

## CLI (Command Line Interface)
Ten CMS posiada możliwość wykonywania poleceń za pomocą terminala. Dodatkowe informacje na temat CLI CodeIgnitera pod adresem https://codeigniter.com/userguide3/general/cli.html
Poniżej opis dostępnych poleceń:
- `php index.php tools help` - Wyświetla dostępne polecenia
- `php index.php tools migration "file_name"` - Tworzy nowy domyślny plik migracji. Lokalizacja utworzonych plików migracji: /application/database/migrations/
- `php index.php tools migrate ["version_number"]` - Wykonuje wszystkie migracje. Numer wersji jest opcjonalny.
- `php index.php tools seeder "file_name"` - Tworzy nowy plik z danymi do zasilenia tabeli bazy danych. Wykorzystuje klasę Faker. Lokalizacja utworzonych plików seeda: /application/database/seeds/
- `php index.php tools seed "file_name"` - Uruchamia wskazany plik seeda.
- `php index.php tools model "model_name"` - Tworzy nowy plik modelu w lokalizacji /application/modules/admin/models/.

## Ion Auth
Panel administracyjny wykorzystuje mechanizm autentykacji Ion Auth 3. Umożliwia zarządzanie użytkownikami oraz grupami użytkowników. Dokumentacja dostępna na stronie https://github.com/benedmunds/CodeIgniter-Ion-Auth

## Faker
CMS korzysta z biblioteki Faker do generowania fikcyjnych danych przydatnych do szybkiego zasilenia bazy danych dużą ilością danych testowych (np. fikcyjne profile użytkowników).

## GULP
Kompilacja plików SCSS panelu admina oraz widoku dla gości.
Po zakończeniu instalacji uruchom `npm install`, a następnie `npm start` (uruchomienie serwisu w domyślnej przeglądarce, uruchomienie watchera na modyfikacje plików szablonów, live reload). W pliku `gulpfile.js` możesz zobaczyć zadania dostępne w środowisku deweloperskim.

### Zadania GULP
Zadania GULP podzielone są ze względu na dostęp do zasobów. Osobne zadania dotyczą plików panelu administracyjnego, osobne zadania dotyczą plików dostępnych dla niezalogowanych użytkowników (gości serwisu). Dostępne są także zadania wspólne. Poniżej opis dostępnych zadań GULP:

#### Zadania GULP dla panelu administracyjnego:
-   `gulp css` kompiluje pliki SCSS do CSS i kompresuje skompilowane CSS. Dotyczy tylko panelu administratora.
-   `gulp deploy` przesyła utworzone pliki CSS na serwer poprzez FTP. Konfiguracja dostępu FTP w pliku gulp_config.js (jeśli go nie posiadasz edytuj plik gulp_config.js.sample i zmień mu nazwę na gulp_config.js). Dotyczy tylko plików panelu administracyjnego.

#### Zadania GULP dla plików przeznaczonych dla niezalogowanych użytkowników:
-   `gulp cssFrontend` kompiluje pliki SCSS do CSS i kompresuje skompilowane CSS. Dotyczy tylko części przeznaczonej dla niezalogowanych użytkowników.
-   `gulp deployFrontend` przesyła utworzone pliki CSS na serwer poprzez FTP. Konfiguracja dostępu FTP w pliku gulp_config.js (jeśli go nie posiadasz edytuj plik gulp_config.js.sample i zmień mu nazwę na gulp_config.js). Dotyczy tylko plików widoku dla osób niezalogowanych.

#### Zadania GULP pozostałe
-   `gulp` domyślne zadanie, wykonuje wszystko
-   `gulp watch` browserSync opens the project in your default browser and live reloads when changes are made
-   `gulp js` kompresuje plik JS motywu.
-   `gulp vendor` kopiuje zależności z node_modules do folderu vendor