Configuration and environments
==============================

There are multiple problems with a typical approach to configuration:

- Each team member has its own configuration options. Committing such config will affect other team members.
- Production database password and API keys should not end up in the repository.
- There are multiple server environments: development, testing, production. Each should have its own configuration.
- Defining all configuration options for each case is very repetitive and takes too much time to maintain.

In order to solve these issues Yii introduces a simple environments concept. Each environment is represented
by a set of files under the `environments` directory. The `init` command is used to initialize an environment. What it really does is
copy everything from the environment directory over to the root directory where all applications are.

By default there are two environments: `dev` and `prod`. First is for development. It has all the developer tools
and debug turned on. Second is for server deployments. It has debug and developer tools turned off. 

Typically environment contains application bootstrap files such as `index.php` and config files suffixed with
`-local.php`. Local configs in `environments` directory are templates that, after `init` is executed, 
are being copied into corresponding application config directories. After that, they become your local configuration.
They are meant to keep secret and environment-specific settings, such as database connection credentials,
and aren't meant to be put into version control system. Thus these files are added to `.gitignore` so git is not
considering them for staging.

In order to avoid duplication configurations are overriding each other. For example, the frontend reads configuration in the
following order:

- `common/config/main.php`
- `common/config/main-local.php`
- `frontend/config/main.php`
- `frontend/config/main-local.php`

Parameters are read in the following order:

- `common/config/params.php`
- `common/config/params-local.php`
- `frontend/config/params.php`
- `frontend/config/params-local.php`

The later config file overrides the former.

Here's the full scheme:

![Advanced application configs](images/advanced-app-configs.png)
