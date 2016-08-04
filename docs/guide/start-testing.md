Testing
===============================

Yii2 Advanced Application uses Codeception as its primary test framework. 
There are already some sample tests prepare in `tests` directory of `frontend`, `backend`, and `common`.
Tests require **additional database**, which will be cleaned up between tests. 
Create database `yii2advanced_test` in mysql (according to config in `common/config/test.php`) and execute: 

```
./yii_test migrate
```

Then all sample tests can be started by running:

```
composer exec codecept run
```

You will see output similar to this:

![](images/tests.png)

It is recommended to keep you tests up to date. If a class, or functionality is deleted, corresponding tests should be deleted as well.
You should run tests regularly, or better to set up Continuous Integration server for them.  

Please refer to [Yii2 Framework Case Study](http://codeception.com/for/yii) to learn how to configure Codeception for your application.

### Common

Tests for common classes are located in `common/tests`. In this template there are only `unit` tests.
Execute them by running:

```
composer exec codecept run -- -c common 
```

`-c` option allows to set path to `codeception.yml` config.

Tests in `unit` test suite (located in `common/tests/unit`) can use Yii framework features: `Yii::$app`, Active Record, fixtures, etc.
This is done because `Yii2` module is enabled in unit tests config: `common/tests/unit.suite.yml`. You can disable it to run tests in complete isolation. 


### Frontend

Frontend tests contain unit tests, functional tests, and acceptance tests.
Execute them by running:

```
composer exec codecept run -- -c frontend
```

Description of test suites:

* `unit` ⇒ classes related to frontend application only.
* `functional` ⇒ application internal requests/responses (without a web server).
* `acceptance` ⇒ web application, user interface and javascript interactions in real browser.

By default acceptance tests are disabled, to run them use:

#### Running Acceptance Tests

To execute acceptance tests do the following:  

1. Rename `frontend/tests/acceptance.suite.yml.example` to `frontend/tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

5. Start web server:

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

6. Now you can run all available tests

   ```
   composer exec codecept run acceptance -- -c frontend
   ```

## Backend

Backend application contain unit and functional test suites. Execute them by running:

```
composer exec codecept run -- -c backend 
```