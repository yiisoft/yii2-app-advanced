Aplikacje
=========

W zaawansowanym szablonie znajdują się trzy aplikacje: front-end, back-end i konsola. Front-end to część, którą 
zwyczajowo prezentuje się użytkownikowi końcowemu, właściwy projekt. Back-end to panel administracyjny, statystyki, 
analiza i podobne funkcjonalności. Konsola jest zwykle używana do obsługi zadań Crona i niskopoziomowego zarządzania 
serwerem. Dodatkowo wykorzystywana jest w trakcie inicjalizowania aplikacji oraz obsługi migracji i assetów.

W szablonie znajduje się również folder `common`, zawierający pliki używane przez więcej niż jedną z aplikacji. 
Przykładowo model `User`.

Zarówno front-end jak i back-end to aplikacje web i dlatego obie zawierają folder `web`. Jest to folder docelowy, na 
który powinna wskazywać domena serwera web.

Każda z aplikacji ma własną przestrzeń nazw i alias odpowiadający swojej nazwie. To samo dotyczy folderu common.
