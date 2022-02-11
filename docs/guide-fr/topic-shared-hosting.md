Utilisation du modèle de projet avancé sur un hébergement partagé
=================================================================

Le déploiement d'un modèle de projet avancé sur un hébergement partagé est un peu plus délicat que le déploiement du projet *basic* parce qu'il a deux racines Web que les serveurs Web des hébergements partagés ne prennent pas en charge. Il faut adapter la structure des dossiers de manière à ce que l'URL de l'interface utilisateur soit `http://site.test` et celle de l'interface d'administration `http://site.test/admin`.

### Déplacement des scripts d'entrée dans une racine Web unique

En premier lieu, il faut un dossier qui serve de racine Web. Créez un nouveau dossier et appelez-le de manière à ce qu'il corresponde à votre nom de racine Web, p. ex. `www` ou `public_html`, ou similaire. Ensuite, créez la structure suivante dans laquelle `www` est la racine Web de l'hébergement que vous venez juste de créer :
```
www
    admin
backend
common
console
environments
frontend
...
```

`www` sera notre dossier de l'interface utilisateur, c'est pourquoi il faut déplacer le contenu de `frontend/web` dedans. Déplacez le contenu de `backend/web` dans `www/admin`. Dans les deux cas, vous devez adapter les chemins dans `index.php` et `index-test.php`.

### Adaptez les sessions et les témoins de connexion (cookies)

À l'origine l'interface d'administration et l'interface utilisateur sont prévues pour s'exécuter dans des domaines différents. Lorsqu'on les rassemble dans le même domaine, elles vont partager les mêmes témoins de connexion, ce qui crée une collision. Pour régler cela, adaptez la configuration de  l'interface d'administration `backend/config/main.php` comme suit :

```php
'components' => [
    'request' => [
        'csrfParam' => '_csrf-backend',
        'csrfCookie' => [
            'httpOnly' => true,
            'path' => '/admin',
        ],
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_identity-backend',
            'path' => '/admin',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        // ceci est le mom du témoin de connexion de session utilisé pour la connexion à l'interface d'administration
        'name' => 'advanced-backend',
        'cookieParams' => [
            'path' => '/admin',
        ],
    ],
],
```

### Installation alternative

Si la manière d'installer le modèle de projet présentée ci-dessus ne fonctionne pas dans votre cas, essayez
[configurations et documentation d'Oleg Belostotskiy](https://github.com/mickgeek/yii2-advanced-one-domain-config).
