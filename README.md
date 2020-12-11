# Projet Cinéma

## Récupérer le projet git (premier démarrage)
- Ouvrir un terminal
- Créer un répertoire dans lequel on va cloner le projet et se placer dedant :
``` 
mkdir projet-cinema
cd projet-cinema
```
- Cloner le projet :
``` 
git clone https://forge.iut-larochelle.fr/apiscart/dwcs-lp-piscart-darphel-barcon-chalumeau.git 
```
## Mise en place de l'environnement de développement

- Se placer dans le répertoire du projet :
```
cd dwcs-lp-piscart-darphel-barcon-chalumeau
```
- Lancer les conteneurs Docker pour démarrer la stack :
```
docker-compose up --build
```
- Ouvrir un autre terminal
- Démarrer le container Docker du back-office :
```
docker exec -it dfs-bo /bin/bash
```
- Se placer dans le répertoire du back-office :
```
cd back-office
```
- Installer les dépendances avec **composer** :
```
composer install
```
- Mettre à jour le schéma de la base de données :
```
bin/console doctrine:schema:update --dump-sql
bin/console doctrine:schema:update --force
```
- Remplir la base de données avec un jeu de données (fixtures) :
```
php bin/console doctrine:fixtures:load
```
Dans un navigateur on peut voir le rendu de notre application :
http://localhost:9999/index.php

Dans un navigateur on peut accéder aux instructions ayant permi de développer notre application :
http://localhost:9996/

Dans un navigateur on peut accéder aux données de notre base de données avec phpmyadmin :
http://localhost:9997/

## Commandes importantes

### Docker

- Pour démarrer la stack :
```
docker-compose up --build
```
- Pour arrêter tous les containers en cours d'execution :
```
docker stop $(docker ps -q) // ou CTRL+C
```
- Pour voir quels containers sont en cours d'execution :
```
docker ps
```
- Pour exécuter une application incluse dans un container, nous utilisons ```docker exec``` :
```
docker exec -it dfs-bo /bin/bash
```

### Git

// TODO

### Exécuter les tests (PHPUnit)

- Démarrer le container Docker du back-office si ce n'est pas déjà fait :
```
docker exec -it dfs-bo /bin/bash
```
- On execute les tests avec la commande suivante:
```
vendor/bin/phpunit tests --color=always --testdox
```

### Gestion des dépendances

- Installer des nouvelles dépendances :
```
composer require tagPackage
```
- Désinstaller des dépendances :
```
composer remove tagPackage
```
- Prendre en compte les nouveaux changements :
```
composer dumpautoload
```
- Consulter la liste des dépendances installées(deux méthodes simples) :
1) Ouvrir le fichier composer.json pour voir directement les packages installés
2) 
```
composer show
```
- Installer les dépendances si elles ne sont pas installés :
```
composer install
```

## Design Patterns et principes SOLID

https://miro.com/welcomeonboard/DuNiiBsU8DGNmoKkT8QHtvWlcCJanaVUjp0MAqdAHPm76smnFrHQ2WiVxw4DDuup

