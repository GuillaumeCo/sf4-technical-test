# Compte rendu

#### Temps passé : 5h30
* Partie Backend (installation et applicatif) : 3h30
* Partie HTML/CSS : 40min
* Essai sur les tests : 40min
* Bonus (Docker) : 40min

#### Points bloquants et difficultés:
* Premier projet sur Symfony 3.4 et perte de temps sur la découverte de l'autowiring, des erreurs sur l'appel de mon service sans savoir vraiment pourquoi. Au final une premier erreur sur une mauvaise façon de l'appeler, et ensuite sur le fait que les services sont privés par défaut 
* Les tests, première fois que j'essaye vraiment d'en faire. Mais blocage aussi au niveau du lancement des tests à cause, à priori, du composant yaml de Symfony

Installation du projet avec Docker
----------------------------------

#### Prérequis

Docker et Docker Compose doivent être installés.

>Installation de Docker : https://docs.docker.com/engine/installation/

>Installation de Docker Compose : https://docs.docker.com/compose/install/


#### Clone du projet depuis Git :
```
$ git clone https://github.com/GuillaumeCo/sf4-technical-test.git sf4-technical-test
```


#### Installation et lancement des containers Docker :

Se rendre dans le dossier du projet et lancer la commande d'initialisation :
```bash
$ cd sf4-technical-test ; make install
```

La commande va demander des informations pour configurer la base de données ainsi que les fichiers 'parameters.yml' et '.env'.

```bash
DB_USERNAME : root
DB_PASSWORD : root
```
> **Note :**
> Le username et le password sont des exemples, il est possible d'en mettre d'autres. La base MySQL sera configurée avec ces identifiants.


#### Accès au site et à phpMyAdmin :

Site : http://sf4-technical-test.localhost:4200

phpMyAdmin : http://phpmyadmin.localhost:4200


#### Commandes disponibles :

- Stopper les containers : `$ make stop`

- Démarrer les containers : `$ make start`

- Nettoyer le cache de Symfony : `$ make clear`

- Se connecter en root au container : `$ make bash-root`

- Se connecter avec l'utilisateur www-data au container : `$ make bash`




# StadLine Technical Test

### Tache

Le sujet de base est simple : Il faut créer une page sécurisée qui permet à un utilisateur de se loguer et de faire un commentaire sur un dépôt publique d'un utilisateur GitHub.
La fonctionnalité de commentaire n'existe pas sur Github, vous devrez donc stocker et afficher ces commentaires dans votre espace sécurisé.

### Règles

* Le temps est libre mais il est tout de même conseillé de passer moins de 4h sur le sujet (temps de setup d'environnement compris)
* Il est conseillé de finir les points requis avant de s'attaquer au bonus. 
* Il est aussi conseillé de faire un maximum de commit pour bien détailler les étapes de votre raisonnement au cours du développement.
* N'hésitez pas à nous faire des retours et nous expliquer les éventuelles problématiques bloquantes que vous auriez rencontrées durant le développement vous empéchant de finir.

### Setup

* La charte graphique n'est pas imposée et sera jugée en bonus. L'emploi d'un framework CSS type Twitter Bootstrap est fortement conseillé. 
* Vous aurez besoin d'un environnement php5.5, Symfony2 et un serveur pour l'application. 

### Les pré-requis

* Vous êtes libre d'utiliser un bundle d'authentification externe ou votre propre bundle. 
* Le formulaire de connexion doit avoir une validation coté serveur. 
* Toutes les pages doivent être sécurisées et pointer sur la page de login si l'utilisateur n'est pas connecté. 
* Le choix du client HTTP est laissé à discrétion pour appeller l'API de GitHub.
* Une fois connecté, il est nécessaire d'implémenter un champ de recherche qui permette de chercher les utilisateurs GitHub. La documentation est disponible ici : https://developer.github.com/v3/search/#search-users . 
* Vous devez appeller l'API suivante avec q=searchFieldContent :
```
https://api.github.com/search/users
```
* Une fois le champ de recherche validé et l'utilisateur sélectionné, on arrive sur l'url /{username}/comment, on affiche un formulaire qui sera composé des champs suivants : un champ texte pour le nom d'un dépôt ({user}/{repos}, e.g : stadline/sf2-technical-test), un textArea pour le commentaire, un bouton valider permettant d'ajouter un commentaire. 
* On affichera en dessous la liste des commentaires déjà saisis pour l'utilisateur.
* Lors de la validation du formulaire, on vérifiera que le repository sélectionné est bien un dépôt appartenant à l'utilisateur précédement recherché.
* On attend aussi de vous que le code soit testable et testé.

### Bonus

* On changera le choix du dépôt par un multiselect afin de lister directement dans le formulaire les dépôts de l'utilisateur. 
* Utilisation d'un frameworkJS pour afficher les résultats
* Toutes les fonctionnalités que vous aurez le temps d'ajouter seront aussi bonnes à prendre. Un bonus autour de votre créativité pourra être considéré.

### Délivrabilité

* Forkez le projet sur GitHub et codez directement dans le projet forké. 
* Commitez aussi souvent que possible et commentez vos commits pour détailler votre chemin de pensée. 
* Mettez à jour le README pour ajouter le temps passé et tout ce que vous jugerez nécessaire de nous faire savoir. 
* Envoyez le lien avec le projet à recrutement@stadline.com. 

**Bonne chance !**
