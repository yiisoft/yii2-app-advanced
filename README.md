CONTENTS OF THIS FILE
---------------------
   
 * [Introduction](#introduction)
 * [Requirements](#requirements)
 * [Helper Scripts](#helper-scripts)
 * [Quickstart](#quickstart)
 * [Developing for the CMS](#developing-for-the-cms)
 * [Helper Scripts](#helper-scripts)
 * [Docker Compose](#docker-compose)
 * [Phing](#phing)
 * [Configuration](#configuration)
 
INTRODUCTION
------------

TBD

REQUIREMENTS
------------

Before continuing you will need to ensure you have the following installed:

 * [Docker](https://www.docker.com)
 * [Docker Compose](https://docs.docker.com/compose)
 
QUICKSTART
----------

These instructions assume you have a local directory located at `~/Development`. If you choose to place this project in a different directory you will need to allow for that when following them.

From a terminal window

```

$ cd ~/Development                                              # Change to the development directory  
$ git clone git@github.com:mobilejazz/yii2-mj-cms-example.git   # Clone the yii2-mj-cms-example project
$ cd yii2-mj-cms-example                                        # Change to the project directory
$ bin/build.sh                                                  # Run the build script
```

When the process completes you will be able to access the CMS at:

* Frontend  [http://localhost](http://localhost)
* Backend   [http://localhost/admin](http://localhost/admin)

DEVELOPING FOR THE CMS
----------------------

If you wish to make changes to the `yii2-mj-cms` project you can use this project as an environment in which to run and test.

From a terminal window:

```  
$ cd ~/Development                                      # Change to the development directory
$ git clone git@github.com:mobilejazz/yii2-mj-cms.git   # Clone the yii2-mj-cms project
```

Edit the Composer file located at `~/Development/yii2-mj-cms-example/src/composer.json`

```json
{
  "type": "vcs",
  "url": "https://github.com/mobilejazz/yii2-mj-cms.git"
}
```

Needs changed to:

```json
{
  "type": "path",
  "url": "/Development/yii2-mj-cms"
}
```

```
$ cd ~/Development/yii2-mj-cms-example                  # Change to the yii2-mj-cms directory  
$ bin/composer.sh update -vv                            # Clone the yii2-mj-cms project
```

You can now make changes to the Yii2 MJ CMS project code located in `~/Development/yii2-mj-cms` and those changes will be reflect in the test project.

**NOTE:** Do not commit the change to the composer.json file

In order to correctly access some private repositories on Bitbucket and to get past the api rate limit for Github you may need to provide auth tokens. This can be done by adding a file called `auth.json` in the `~/Development/yii2-mj-cms-example/src/` directory which looks like this:

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

You will find instructions for creating these tokens here:

* [Bitbucket](https://confluence.atlassian.com/bitbucket/oauth-on-bitbucket-cloud-238027431.html#OAuthonBitbucketCloud-Createaconsumer) Please ensure all read permissions are enabled for the Consumer you create.
* [Github](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/) Please ensure all read permissions are enabled.

**NOTE:** You don't have to worry about this file being checked in as git is configured to ignore it.

HELPER SCRIPTS
--------------

In addition to the `bin/build.sh` script there are several other helpers script designed to make it easy to perform common Yii2 related development tasks within the docker container.

 * `bin/stop.sh` will stop the docker containers
 * `bin/start.sh` will start the docker containers
 * `bin/exec.sh` will execute whatever command you want from within the docker environment e.g. `bin/exec.sh composer update -vv`
 * `bin/composer.sh` is a utility script built on top of `bin/exec.sh` for running composer related tasks
 * `bin/phing.sh` is a utility script built on top of `bin/exec.sh` for running phing related tasks
 * `bin/codecept.sh` is a utility script built on top of `bin/exec.sh` for running codecept related tasks
 * `bin/yii.sh` is a utility script built on top of `bin/exec.sh` for running yii related tasks
 * `bin/yii_test.sh` is a utility script built on top of `bin/exec.sh` for running yii_test related tasks
 
DOCKER COMPOSE
--------------

You can examine the `docker-compose.yml` and see that we are creating 3 docker containers:

 * `db` which is a mysql instance
 * `adminer` which runs [Adminer](https://www.adminer.org), is linked to the `db` instance and exposes a web service on port `8080`
 * `web` which is an instance of [Yii2 Docker](https://hub.docker.com/r/mobilejazz/yii2-docker), is linked to the `db` instance and creates our Apache2/PHP5 environment exposing the web service on port `80`

Other things to note are:

 * The `src` directory is mapped as a volume into the `/var/www/html` directory of the `web` container.
 * When interacting within the `web` container, running updates to dependencies etc, you will do so as the `www-data` user. This is important as the `www-data` user has a uid of `1000` which should correspond to your user id outside of the container. This will ensure you do not encounter file permission issues whereby the `vendor` directory cannot be deleted.

PHING
-----

[Phing](https://www.phing.info) is a build tool that allows for various tasks to be defined and executed. You can see these are defined within the `src/build.xml` file. You can execute them as follows:

 * `bin/phing.sh init -Denv=local` will run the `init` script
 * `bin/phing.sh update` will run a composer update and a Yii migrate
 * `bin/phing.sh docker.init` is used to initialise the environment when a docker image is built

CONFIGURATION
-------------

TBD
  