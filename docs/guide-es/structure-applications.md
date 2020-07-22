Aplicaciones
============

Hay 3 aplicaciones en la plantilla avanzada: frontend, backend y consola. Frontend es tipicamente lo que se presenta a los usuarios finales, el proyecto en si. Backend
es el panel de administración, analítica y tales funcionalidades. Consola es tipicamente usado para cron jobs y administración del servidor a bajo nivel. También
es usado durante el despliegue de la aplicación y para manejar migraciones y assets.

También hay un directorio `common` que contiene los archivos usados por mas de una aplicación. Por ejemplo, el modelo `User`.

frontend y backend son ambas aplicaciones web y ambas contienen el directorio `web`. Este es el webroot al que debería apuntar tu servidor web.

Cada aplicación tiene su propio namespace y alias que corresponde a su nombre. Lo mismo se aplica al directorio common.
