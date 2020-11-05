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
