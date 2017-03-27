Applications
============

Il y a trois applications dans le modèle de projet avancé : l'interface utilisateur (*frontend*), l'interface d'administration (*backend*) et la console. L'interface utilisateur est ce qui est présenté à l'utilisateur final, le projet lui-même. L'interface d'administration est un paneau d'administration qui permet l'administration, des analyses et des fonctionnalités de ce genre. La console est typiquement utilisée pour des tâches de cron et la gestion de bas niveau du serveur. C'est pourquoi on l'utilise durant le déploiement de l'application pour la gestion des migrations et des ressources. 

Il existe aussi un dossier `common` (partagé) qui contient les fichiers utilisés par plus d'une application. Par exemple, le modèle `User` (utilisateur). 

L'interface utilisateur et l'interface d'administration sont toutes deux des applications Web et contiennent toutes deux un dossier `web`, qui représente la racine Web vers laquelle vous devez pointer votre serveur Web. 

Chacune des applications possède son propre espace de noms et son propre alias correspondant à son nom. La même chose vaut pour le dossier `common`.
