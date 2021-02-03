# Projet Cinéma

## Récupérer le projet git (premier démarrage)
- Ouvrir un terminal
- Créer un répertoire dans lequel on va cloner le projet et se placer dedans :
``` 
mkdir projet-cinema
cd projet-cinema
```
- Cloner le projet :
``` 
git clone https://forge.iut-larochelle.fr/apiscart/dwcs-lp-piscart-darphel-barcon-chalumeau.git 
```
## Mise en place de l'environnement de développement

### Docker
- Lancer les conteneurs Docker pour démarrer la stack :
```
docker-compose up --build
```

### BO
- Se placer dans le répertoire du projet :
```
cd dwcs-lp-piscart-darphel-barcon-chalumeau
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
- A la racine du back-office, il faut créer un fichier .env.local et un fichier .env.test.local et écrire la ligne suivante dans les deux fichiers :
```
DATABASE_URL="mysql://cine32:cine32@dfs-mysql:3306/cine32?serverVersion=mariadb-10.4.10"
```

## API
- Ouvrir un autre terminal
- Démarrer le container Docker de l'api :
```
docker exec -it dfs-api /bin/bash
```
- Se placer dans le répertoire de l'api :
```
cd api
```
- Installer les dépendances avec **composer** :
```
composer install
```
- A la racine de l'api, il faut créer un fichier .env.local et un fichier .env.test.local et écrire la ligne suivante dans les deux fichiers :
```
DATABASE_URL="mysql://cine32:cine32@dfs-mysql:3306/cine32?serverVersion=mariadb-10.4.10"
```
 Mettre à jour le schéma de la base de données :
```
bin/console doctrine:schema:update --dump-sql
bin/console doctrine:schema:update --force
```
- Remplir la base de données avec un jeu de données (fixtures) :
```
php bin/console doctrine:fixtures:load
```

## Accès à l'application

Dans un navigateur on peut voir le rendu de notre application :
http://127.0.0.1:9999/index.php/admin/cinemas

Dans un navigateur on peut accéder aux instructions ayant permi de développer notre application :
http://localhost:9996/

Dans un navigateur on peut accéder aux données de notre base de données avec phpmyadmin :
http://localhost:9997/

## Exécuter les tests

### BO

- Démarrer le container Docker du back-office si ce n'est pas déjà fait :
```
docker exec -it dfs-bo /bin/bash
```
- Accéder au répertoire du back-office :
```
cd back-office
```
- On execute les tests avec la commande suivante:
```
vendor/bin/phpunit tests --color=always --testdox
```

### API

- Démarrer le container Docker de l'api si ce n'est pas déjà fait :
```
docker exec -it dfs-api /bin/bash
```
- Accéder au répertoire de l'api : 
```
cd api
```
- On execute les tests avec la commande suivante:
```
vendor/bin/phpunit tests --color=always --testdox
```

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

