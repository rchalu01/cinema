# Projet Cinéma

## Mise en place de l'environnement de développement
- Clone le projet : 
``` 
git clone https://forge.iut-larochelle.fr/apiscart/dwcs-lp-piscart-darphel-barcon-chalumeau.git 
```
- Se placer dans le répertoire du projet :
```
cd dwcs-lp-piscart-darphel-barcon-chalumeau
```
- Lancer le conteneur Docker :
```
docker-compose up --build
```

## Commandes docker importantes
- Pour arrêter tous les containers en cours d'execution :
```
docker stop $(docker ps -q)
```
- Pour démarrer la stack :
```
docker-compose up --build
```
- Pour voir quels containers sont en cours d'execution :
```
docker ps
```
- Pour exécuter une application incluse dans un container, nous utilisons ```docker exec``` :
```
docker stop $(docker ps -q)
```

##Mise en place TDD
- On télécharge phpunit en utilisant composer dans le conteneur Docker
```
composer require PHPUnit/PHPUnit --dev
```
- Ensuite on peut tester si php unit est bien disponible
```
vendor/bin/phpunit
```
-On ajoute autoloader dans les composer.json
```
 "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "App\\": "tests/"
        }
    },
```
- On utilise ensuite la commande pour prendre en compte les modifications du composer.json
```
composer dumpautoload
```
- On créer les dossiers test et src
```
mkdir test
mkdir src
```
- On execute le répertoire de test avec la commande suivante:
```
vendor/bin/phpunit test --color=always
```