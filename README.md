# Pour utiliser ce projet: 

- faites un `git clone` ou un download du projet
- `composer install`
- Pour lancer le serveur :  `php bin/console server:run`

 # Accès BDD
 - créer la BDD en local. 
 - créer un fichier .env.local à la racine du projet et remplacer les valeurs `user-login`, `password` et `database-name` avec les vraies valeurs:
> DATABASE_URL=mysql://user-login:password@127.0.0.1:3306/database-name

# Création des tables dans la BDD
Pour créer les tables dans la BDD, faire :
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`

# Injection des données dans la BDD
Pour mettre les données dans la BDD, faire :
- `php bin/console doctrine:fixtures:load`

# User story 
La descriptions des besoins est effectué via les Issues de ce repository GitHub

# Front End
Un Front par defaut est proposé ici : https://github.com/Safiamoon/unit-comparator-front

# API
Nom des attibuts des requetes POST
- ### valueToConvert :
> Le nombre ou la donnée à convertir
- ### inUnit:
> L'unité de conversion d'entrée
- ### outUnit:
 > L'unité de conversion de sortie
 >
 Valeurs possibles :
>squareMeterToHectare : Convertion de m² à hectare
>
>kwToKgCo2 : Convertion de Kw/h en Kg de Co2
>

