Creating links from backend to frontend
=======================================

Often it's required to create links from the backend application to the frontend application. Since the frontend application may
contain its own URL manager rules you need to duplicate that for the backend application by naming it differently:

```php
return [
    'components' => [
        'urlManager' => [
            // here is your normal backend url manager config
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // class is required on custom named url managers!
            'hostInfo' => 'https://example.com',    // the full base domain name to use for the links
            // here is your frontend URL manager config
        ],

    ],
];
```

The URL Manager doesn't magically know the root URL of another app on another sub-domain. This is where the `hostInfo` param
comes in. It defines the full domain for the URL manager to generate absolute links with.

You may need to generate links to the frontend or any another app (ie: [topic-adding-more-apps.md](topic-adding-more-apps.md)). You can have multiple URL managers for multiple apps on multiple sub-domains.

```php
return [
    'components' => [
        'urlManager' => [
            // here is your normal backend URL manager config
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // class is required on custom named URL managers!
            'hostInfo' => 'https://example.com',    // the full base domain name to use for the links
            // here is your frontend URL manager config
        ],
        'urlManagerBlog' => [
            'class' => 'yii\web\UrlManager',            // class is required on custom named URL managers!
            'hostInfo' => 'https://blog.example.com',   // the full base domain name to use for the links
            // here is your blog URL manager config
        ],

    ],
];
```

After it is done, you can get a URL pointing to the frontend like the following:

```php
echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(...);
```

When you have custom rules that need to be repeated across multiple apps, you should place them in their
own "rules" files. This way, when you need to make a change, you only need to modify one file.

In the `common/config` directory, create a new folder named `rules`. This will house all of your URL manager rules.

Then create a file named `backend-rules.php` and another named `frontend-rules.php`.

If the respective app doesn't have/need any rules, just have the rules file return an empty array.

```php
<?php
return [];
```

Here is an example of what it looks like with some custom rules:

```php
<?php
return [
    'aff/<id:\d+>' => 'affiliate/index',
    'lp/<id:\d+>' => 'landing/index',
];
```

Now just include/require the respective rules files for the corresponding URL managers:

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            // backend URL manager
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/backend-rules.php'),
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // class is required on custom named url managers!
            'hostInfo' => 'https://example.com',    // the full base domain name to use for the links
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/frontend-rules.php'),
        ],
        // ...

    ],
    // ...
];
```

## Hardcoded hostInfo URL

The examples above are to illustrate what is expected in the field. `hostInfo` expects a full domain name like `https://example.com` or
`https://backend.example.com`. Having a hard-coded domain in your config isn't very practical. Especially for handling multiple environments
(local, staging, production, etc).

There are a few ways you can do this. The following way allows you to make use of Yii's environments and the `init` process.

We first need to load functions early on during Composer's autoload.

In your `composer.json` file, add the following:

```json
"autoload": {
    "files": [
        "common/functions.php"
    ]
}
```

Now create `common/functions.php`:

```php
<?php
/**
 * Requires `define('USE_HTTPS', true)` to be in your `index.php` file!
 */
function getUrlScheme()
{
    return (USE_HTTPS === true) ? 'https' : 'http';
}

/**
 * Requires `define('DOMAIN_NAME', 'example.tld')` to be in your `index.php` file!
 */
function getDomain($subDomain = null)
{
    $sub = $subDomain ? $subDomain . '.' : '';
    return getUrlScheme() . '://' . $sub . DOMAIN_NAME;
}
```

Now we need to define our constants in the corresponding `web/index.php` files. Here are the paths for the default environments.

```
environments/dev/backend/web/index.php
environments/dev/frontend/web/index.php
environments/prod/backend/web/index.php
environments/prod/frontend/web/index.php
```

In the `dev` copies, we will use our local development domain name (ie: mylocalsite.test) and in the `prod` copies we will use the real domain (ie: example.com).

Add to the top of the index files:

**environments/dev/backend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'mylocalsite.test');
```

**environments/dev/frontend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'mylocalsite.test');
```

**environments/prod/backend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'example.com');
```

**environments/prod/frontend/web/index.php**

```php
define('USE_HTTPS', true);
define('DOMAIN_NAME', 'example.com');
```

Run `./init` and initialize the proper environment to overwrite the changes.

We can use the functions directly, or create aliases. Let's create aliases.

Add the following in `common/config/bootstrap.php`:

```php
Yii::setAlias('@frontendDomain', getDomain());              // ex: https://somedomain.tld
Yii::setAlias('@backendDomain', getDomain('backend'));      // ex: https://backend.somedomain.tld
```

Remember `www` is a sub-domain, so pass it like one if you use it like so: `getDomain('www')`

Lastly, with all of that set up, you can simply use the aliases in your main config files:

```php
return [
    // ...
    'components' => [
        'urlManager' => [
            // backend URL manager
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/backend-rules.php'),
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',        // class is required on custom named URL managers!
            'hostInfo' => Yii::getAlias('@frontendDomain'),    // the full base domain name to use for the links
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require Yii::getAlias('@common/config/rules/frontend-rules.php'),
        ],
        // ...

    ],
    // ...
];
```
