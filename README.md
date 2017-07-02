# SmartFact

This repository contains the source code of the "open" project as asked in the EII path at OpenClassrooms.

**_Please note that the code present here is only part of the backend->frontend logic, the mobile
applications are available on other repositories._**

### iOS application

### Android application

## About

_Contexte_

Vous devez développer une application mobile ayant un objectif social. Il peut s'agir d'un nouveau projet que vous rêviez de faire depuis longtemps ou d'une idée que vous allez chercher spécifiquement pour réaliser ce projet, du temps que celle-ci propose un impact social positif.

_Mission_

Vous allez créer une application mobile pour la plateforme iOS ou Android. Il peut s'agir de n'importe quel type d'application (jeu ludo-éducatif, santé, utilitaire...).

L'application devra fonctionner de pair avec un serveur : il y aura donc une communication via une API sur ce serveur. Celui-ci stockera des informations dans une base de données qu'il pourra transmettre aux applications mobiles.

L'application fonctionnera donc sur le modèle suivant :

- Communication entre applications mobiles et serveur

![Communication entre applications mobiles et serveur](https://user.oc-static.com/upload/2016/12/29/14830188284661_smartphones_serveur.png)

Ce schéma est très courant pour de nombreuses applications. A vous de veiller à concevoir une application qui respecte ce modèle.

Vous porterez une attention particulière au modèle de données choisi, qui doit être efficace et cohérent. Vous devrez en particulier prouver qu'il tient la charge si votre application rencontre un succès rapide (souvenez-vous des débuts difficiles de Pokémon Go !). Sélectionnez donc avec soin votre méthode d'hébergement pour qu'elle puisse facilement passer à l'échelle.

**_Si votre application comporte plus de 3 écrans différents, elle risque de vous demander beaucoup de travail, faites attention.
Il est facile de se laisser déborder par le périmètre d'une application. Nous vous recommandons de vous efforcer à concevoir quelque chose de suffisamment simple._**

Quelques exemples d'applications

Les applications suivantes répondent aux critères du projet. Vous pouvez vous en inspirer, mais n'hésitez pas à partir sur une autre idée qui vous tient à coeur :

- Une liste de missions bénévoles proposées par des associations à proximité
- Un jeu éducatif pour apprendre à trier ses déchets dont les scores et la position des joueurs sont synchronisés avec un serveur
- Une application de suivi de santé pour un médecin et ses patients, qui servirait en-dehors des rendez-vous médicaux.

Si vous avez une idée et que vous n'êtes pas certain·e qu'elle ait un minimum d'impact social, posez la question à votre mentor qui pourra vous aider à trancher.

Bonus : c'est encore mieux si votre application est basée sur de vraies données (de vrais besoins d'une association par exemple), mais vous pouvez tout à fait inventer un scénario si besoin.
Prenez le temps de déterminer l'objectif de votre application avec soin. Elle pourra servir à valoriser votre savoir-faire sur votre CV et votre portfolio !

**_Livrables à fournir_**

- Modèle de données
- Résultats du test de charge du serveur de base de données
- Code source de l'application mobile


## Build

This project is followed and tested inside a CI process, with this approach, the project is completely
tested and easily maintainable, here's the tools who help the development process : 

### Insight

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7d68b2b6-6303-4e81-aebb-bc6a7aab1baf/big.png)](https://insight.sensiolabs.com/projects/7d68b2b6-6303-4e81-aebb-bc6a7aab1baf)

### Gitlab

### Blackfire

## Usage

This project is build using Docker along with PHP, Nginx, Postgres, MySQL, MongoDB and Blackfire.

This way, the project can be used in differents ways : 

### Docker:

This project use Docker environment files in order to allow the configuration according to your needs,
this way, you NEED to define a .env file in order to launch the build.

**_In order to perform better, Docker can block your dependencies installation and return an error 
or never change your php configuration, we recommand to delete all your images/containers 
before building the project_**

```bash
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -a -q) -f
```

**Note that this command can take several minutes before ending**

Once this is done, let's build the project.

```bash
touch .env
```

Then add the following keys according to your identifiers:

```text
# Global
CONTAINER_NAME=Smartfact

# Servers Ports
NGINX_PORT=port
APACHE_PORT=port
NODE_PORTport
PHP_PORT=port

# DB Ports
MYSQL_PORT=port
POSTGRES_PORT=port
MONGO_PORT=port
MAIL_DEV_PORT=port

# Database
DB_USERNAME=db
DB_PASSWORD=db
DB_NAME=db

# Blackfire
BLACKFIRE_PORT=port
BLACKFIRE_CLIENT_ID='blc'
BLACKFIRE_CLIENT_TOKEN='blc'
BLACKFIRE_SERVER_ID='blc'
BLACKFIRE_SERVER_TOKEN='blc'
```

Then build the project:

```bash
docker-composer up -d --build
```

Then you must use Composer in order to launch the application : 

```bash
composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest
composer clear-cache
composer dump-autoload --optimize --classmap-authoritative --no-dev
```

Once the project is build, let's play with the database : 

```bash
./bin/console d:d:c  --connection=production # In production

./bin/console d:d:c --connection=development # In development
```

For more informations, please check the official documentation : [Symfony](https://symfony.com/doc/current/doctrine/multiple_entity_managers.html)

Once this is done, access the project via your browser : 

- Dev : 

```
http://localhost:port/app_dev.php/
```

- Prod : 

```
http://localhost:port/app.php/
```

If you need to perform some tasks:

```bash
docker exec -it php-fpm_louvre sh
```

Once in the container:

```bash
# Example for clearing the cache
./bin/console c:c --env=prod || rm -rf var/cache/*
```

**Please note that you MUST open a second terminal in order to keep git ou other commands line outside of Docker**

### PHP CLI

```bash
cd core
php bin/console s:r || ./bin/console s:r
```

Then access the project via your browser: 

```
http://localhost:8000
```

## Assets management

This project is build via Symfony and with the help of React, in order to ease the process, Webpack-Encore is used.

As says in the documentation, Encore help to build and maintain the frontend code, this way, 
this project follow some guidelines, the react components are availables in the web/dev/react/components and
loaded via *.jsx files.

Here the list of commands available : 

```bash
# Build for dev env (only build once)
./node_modules/.bin/encore dev
```
```bash
# Build continuously (the files changes are handled automatically)
./node_modules/.bin/encore dev --watch
```
```bash
# Build for production use (with minification)
./node_modules/.bin/encore production
```

**_Please note that this project has been built with Docker so if you use this last one, 
you MUST use the docker exec command in order to access the ./node_modules folder._**

This commands helps in the development process, in order to be effective, here the recommendations for this 
project : 

### Visual assets: 

- Store the SASS files inside the scss folder.
- Define the globals variables inside a globals.scss file.
- Respect the separation of concerns logic, if the rules are concentrated on a single component, make
  a file for AND ONLY FOR this component.

### React components: 

- Use the continuous build in the dev part.
- Build for production ONLY if you're sure about your assets.

## Code architecture

This project isn't a full API + SPA project, in fact, he's build from the ground up with Symfony + Twig, 
React has been used in order to had dynamism, nothing more, this way, the logic is placed from Symfony into React.

In order to ensure code maintainability ...

## Development process 

In order to keep the project upgradable and easy to maintain, we've fixed some
rules to follow in order to develop better code and follow the best practices from both
PHP (aka PSR) and Symfony, here's the details : 

If you find a bug and want to correct it : 

```
git branch -d ISSUE_CONCERNED_PATCH
```

Once this is done, create an PR and submit your patch. 

If you want to add a new functionality or submit an idea : 

```
git branch -d ISSUE_CONCERNED_ADDITION
```

When you develop a new feature or apply a patch, you MUST follow the PSR for code quality and
simplicity, this way, we use [PHP-CS-FIXER](https://github.com/FriendsOfPHP/PHP-CS-Fixer) in order to ease the process, here's the way to launch
the tool in order to manage the code : 

```bash
docker exec -it Smartfact_php-fpm sh

./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix .
```

Once the corrections are applied, please, be sure to check the files who's been edited 
and be sure that nothing into YOUR logic has changed. 

On the other hand, we MUST keep the documentation up-to-date after each modifications, in order
to ease the process, we use [SAMI](https://github.com/FriendsOfPHP/Sami), this way, a sami.phar 
file is available into the _script folder, all the configuration has been done and you only 
need to perform simple task : 

```bash
docker exec -it Smartfact_php-fpm sh

php _script/sami.php
```

## Tests coverage

This project is completely tested and followed by PHPUnit, this way, our code is easily maintainable
and upgradable, here's is the details of the coverage : 


In order to launch the tests, here's the process : 

**Be sure to have build the containers/services**

```bash
docker exec -it smartfact_php-fpm sh 
```

```bash
phpunit -v
```

Once this is done, you should see the different results of tests.

## Performances tests

In order to kepp the application in shape and available by every request, 
we use [Blackfire](https://blackfire.io/) in order to test our performances 
logic and correct the bottleneck, as you can saw, 
the Blackfire Agent/CLI and Probe are installed by the [official Docker image](https://blackfire.io/docs/integrations/docker), 
this way, you can access the different commands directly from the PHP-FPM container : 

```bash
docker exec -it Smartfact_blackfire sh # Name of the container is up to you.

blackfire --help
```

Once the container is build, time to set the client_id and client_token : 

```bash
blackfire config 

# Enter your identifiers.
```

**If you have problems about your server id, please, use the commands below**

```bash
blackfire agent --register 
```

Once this is done, we have access to the Blackfire Agent who can profile our pages
and generate a graph, in order to profile, let's use the container :

```bash
docker exec -it Smartfact_blackfire sh

blackfire curl http://172.20.0.1:PORT/app_dev.php/ # For development env
```

In order to keep the testing logic and profiling "vision" away from the "core" logic, 
we use [Blackfire-Player](https://blackfire.io/docs/player/index),
this tool is used in order to test EVERY pages and and ensure that we have the best 
performances and testing experience.

During the developement phase, you MUST use this tools in order to test every page
you build, let's launch the process : 

```bash
docker exec -it Smartfact_php-fpm sh

blackfire-player run scenarios/dev.bkf # For development tests
blackfire-player run scenarios/prod.bkf # For production tests
```

The approach used is to define folder who contains the different parts of the application, 
this way, this way, the logic can be tested away from the api if you work on the web application.

In order to be effective and help to improve the application, you MUST write tests for both
version (production and development) and both "part" (API and Web) if your features is 
concerned by both parts.

### Note 

When you test the production part, be sure to use the "Production mode" specially build
for this approach, this way, you don't break the production with testing approach

## Production

In order to 
