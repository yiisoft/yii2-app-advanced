Directories
===========

The root directory contains the following subdirectories:

- `backend` - [backend web application](structure-applications.md).
- `common` - [files common to all applications](structure-applications.md).
- `console` - [console application](structure-applications.md).
- `environments` - [environment configs](structure-environments.md).
- `frontend` - [frontend web application](structure-applications.md).

Root directory contains a set of files.

- `.gitignore` contains a list of directories ignored by git version system. If you need something never get to your source
  code repository, add it there.
- `composer.json` - Composer config described in [Configuring Composer](start-composer.md).
- `init` - initialization script described in [Configuration and environments](structure-environments.md).
- `init.bat` - same for Windows.
- `LICENSE.md` - license info. Put your project license there. Especially when opensourcing.
- `README.md` - basic info about installing template. Consider replacing it with information about your project and its
  installation.
- `requirements.php` - Yii requirements checker.
- `yii` - console application bootstrap.
- `yii.bat` - same for Windows.
