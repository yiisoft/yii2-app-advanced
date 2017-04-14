CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Requirements
 * Installation
 * Docker Compose
 * Composer Auth
 * Phing
 * Configuration
 
INTRODUCTION
------------

TBD

REQUIREMENTS
------------

This project requires that you have the following installed:

 * [Docker](https://www.docker.com)
 * [Docker Compose](https://docs.docker.com/compose)

INSTALLATION
------------

The following assumes you are in the root directory of the repository:

 * `bin/build.sh` will build the docker images and start them. Run this the first time you clone or whenever changes are made to the `docker-compose.yml' file.
 * `bin/stop.sh` will stop the docker images
 * `bin/start.sh` will start the docker images
 * `bin/exec.sh` will execute whatever command you want from within the docker environment e.g. `bin/exec.sh composer update -vv`

If you wish to locally map repositories for use within the `web` container you can supply 2 optional arguments to the `bin/build.sh`:

```bash
  ./build.sh [mobilejazz_dir] [mobilejazz-contrib_dir]
  [mobilejazz_dir] Optional directory path where all of your mobilejazz projects are checked out. Maps to /mobilejazz in the container
  [mobilejazz-contrib_dir] Optional directory path where all of your mobilejazz-contrib projects are checked out. Maps to /mobilejazz-contrib in the container
  
```

It's best to setup two environment variables instead: `MOBILEJAZZ_DEV` and `MOBILEJAZZ_CONTRIB`.

TBD an exampe of local development

DOCKER COMPOSE
--------------

You can examine the `docker-compose.yml` and see that we are creating 3 docker containers:

 * `db` which is a mysql instance
 * `adminer` which runs [Adminer](https://www.adminer.org), is linked to the `db` instance and exposes a web service on port `8080`
 * `web` which is an instance of [Yii2 Docker](https://hub.docker.com/r/mobilejazz/yii2-docker), is linked to the `db` instance and creates our Apache2/PHP5 environment exposing the web service on port `80`

Other things to note are:

 * The `src` directory is mapped as a volume into the `/var/www/html` directory of the `web` container.
 * When interacting within the `web` container, running updates to dependencies etc, you will do so as the `www-data` user. This is important as the `www-data` user has a uid of `1000` which should correspond to your user id outside of the container. This will ensure you do not encounter file permission issues whereby the `vendor` directory cannot be deleted.

COMPOSER AUTH
-------------

In order to correctly access some private repositories on Bitbucket and to get past the api rate limit for Github you need to provide auth tokens. This can be done by adding a file called `auth.json` in the `src/` directory which looks like this:

```json
{
  "github-oauth": {
    "github.com": "..."
  },
  "bitbucket-oauth": {
    "bitbucket.org": {
      "consumer-key": "....",
      "consumer-secret": "..."
    }
  }
}

```

This file is ignored by git.

PHING
-----

[Phing](https://www.phing.info) is a build tool that allows for various tasks to be defined and executed. You can see these are defined within the `src/build.xml` file. You can execute them as follows:

 * `bin/phing.sh init -Denv=local` will run the `init` script
 * `bin/phing.sh update` will run a composer update and a Yii migrate
 * `bin/phing.sh docker.init` is used to initialise the environment when a docker image is built

CONFIGURATION
-------------

TBD
  