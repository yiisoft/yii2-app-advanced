Pruebas (_testing_)
===============================

Yii2 Aplicación avanzada utiliza Codeception como framework principal para pruebas.
Existen algunas pruebas ejemplo dentro del directorio `tests` de los directorios `frontend`, `backend`, y `common`.
Para que el siguiente procedimiento funcione, se asume que la aplicación ha sido inicializada utilizando
el entorno `dev`. En caso de que las pruebas requieran ser ejecutadas en un entorno `Production`, `yii_test` y
`yii_test.bat` deberán ser copiados manualmente desde el fólder `environments/dev` dentro del directorio raíz del proyecto.

Las pruebas requieren una **base de datos adicional**, que deberá ser limpiada entre cada prueba.
Crear base de datos `yii2advanced_test` en mysql (acorde a la configuración en `common/config/test-local.php`) y ejecutar:


```
./yii_test migrate
```

Construir las pruebas:

```
vendor/bin/codecept build
```

Todas las pruebas pueden comenzarse, ejecutando:


```
vendor/bin/codecept run
```

Verá un salida similar a esto:

![](images/tests.png)

Es recomendable mantener sus pruebas actualizadas. Si una clase, o funcionalidad es borrada, las pruebas correspondientes deberán ser
borradas tambien.
Deberá correr las pruebas regularmente, o mejor configurar el servidor para Integración Continua.


Por favor referirse a [Yii2 Framework Case Study](https://codeception.com/for/yii) para aprender sobre como configurar Codeception para su aplicación.

### Common

Pruebas para clases en _common_ están ubicadas en `common/tests`. En esta plantilla, solo hay pruebas unitarias.
Ejecútelas con el comando:

```
vendor/bin/codecept run -- -c common
```

Opción `-c` permite establecer la ruta del archivo de configuración `codeception.yml`.

Pruebas en la _suite_ `unit` (ubicadas en `common/tests/unit`) pueden utilizar características de Yii framework: `Yii::$app`, Active Record, fixtures, etc.
Esto debido a que el módulo `Yii2` está habilidado en el archivo de configuración `common/tests/unit.suite.yml`. Usted puede deshabilitarlo para correr
pruebas en completo aislamiento.


### Frontend

Para _frontend_ se contienen pruebas unitarias, funcionales y de aceptación.
Ejecútelas con el siguiente comando:

```
vendor/bin/codecept run -- -c frontend
```

Descripción de las _suites_:

* `unit` ⇒ Clases relacionadas a la aplicacción _frontend_ solamente.
* `functional` ⇒ Peticiones/respuestas internas de la aplicación (sin un servidor web).
* `acceptance` ⇒ Aplicaciones web, interfaz de usuario y interacciones js en un navegador web real.

Por predeterminación, las pruebas están deshabilitadas, para ejecutarlas use:

#### Corriendo pruebas de aceptación

Las pruebas de aceptación utilizan [geckodriver](https://github.com/mozilla/geckodriver) para firefox por predeterminación, por tanto asegurese de que
[geckodriver](https://github.com/mozilla/geckodriver) esté en su `PATH`.

Para ejecutar las pruebas de aceptación, haga lo siguiente:

1. Renombrar `frontend/tests/acceptance.suite.yml.example` a `frontend/tests/acceptance.suite.yml` para habilitar la configuración del conjunto.

1. Reemplazar el paquete `codeception/base` dentro del `composer.json` con `codeception/codeception` para instalar un versión completa Codeception.

1. Actualizar las dependencias con Composer 

    ```
    composer update  
    ```

1. Auto generar nuevas clases soporte para pruebas de aceptación:

    ```
    vendor/bin/codecept build -- -c frontend
    ```

1. Descargar [Selenium Server](https://www.seleniumhq.org/download/) y lanzarlo:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```
    > Hay [issues](https://github.com/facebook/php-webdriver/issues/492) con el geckodriver.
    > Interacciones con selenium que requieran habilitar _protocol translation_ en Selenium.
    > `java -jar ~/selenium-server-standalone-x.xx.x.jar -enablePassThrough false`

1. Comenzar el servidor web:

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

1. Ahora puede correr todas pruebas disponibles:

   ```
   vendor/bin/codecept run acceptance -- -c frontend
   ```

## Backend

La aplicación _backend_ contiene pruebas unitarias y funcionales. Ejecútelas con:

```
vendor/bin/codecept run -- -c backend
```
