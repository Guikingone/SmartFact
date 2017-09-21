# SmartFact

This repository contains the source code of the "open" project as asked in the EII path at OpenClassrooms.

**_Please note that the code present here is only part of the backend->frontend logic, the mobile
applications are available on other repositories._**

### iOS application

[Smartfact-iOS](https://github.com/Guikingone/SmartFact-IOS)

### Android application

### Ionic application

[SmartFact-Ionic](https://github.com/Guikingone/SmartFact-Ionic)

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

This project is build using Docker along with PHP, Nginx, Postgres, MySQL, MongoDB, Redis and Blackfire.

This way, the project can be used in differents ways : 

## Docker 

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
cp .env.dist .env
```

Update the informations linked to Docker then use Docker-Compose : 

```bash
docker-composer up -d --build
```

Then you must use Composer in order to launch the application : 

```bash
docker exec -it project_php-fpm sh 

# Use Composer inside the container for better performances.
composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest
composer clear-cache
composer dump-autoload --optimize --classmap-authoritative --no-dev

# Configure BDD
./bin/console d:m:s:c # for MongoDB users
./bin/console d:s:c # for classic users

# Fixtures
./bin/console d:mf:l -n
```

As this project use NodeJS for frontend assets, we need to build the assets : 

```bash
// TODO
```

Once this is done, access the project via your browser : 

- Dev : 

```
http://localhost:port/
```

**For the production approach, you must update the .env file and change the APP_ENV and APP_DEBUG keys.**

- Prod : 

```
http://localhost:port/
```

If you need to perform some tasks:

```bash
docker exec -it project_php-fpm sh
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
php bin/console s:r || ./bin/console s:r || make serve
```

Then access the project via your browser: 

```
http://localhost:8000
```

**The commands listed before stay available and needed for this approach**

## Tests coverage

This project is completely tested and followed by PHPUnit and Behat, this way, our code is easily maintainable
and upgradable, here's is the details of the coverage : 


In order to launch the tests, here's the process : 

**Be sure to have build the containers/services**

```bash
docker exec -it project_php-fpm sh 
```

- PHPUnit 

```bash
phpunit -v
```

- Behat

```bash
vendor/bin/behat
```

Once this is done, you should see the different results of tests.

## Performances

In order to kepp the application in shape and available by every request, 
we use [Blackfire](https://blackfire.io/) in order to test our performances 
logic and correct the bottleneck, as you can saw, 
the Blackfire Agent/CLI and Probe are installed by the [official Docker image](https://blackfire.io/docs/integrations/docker), 
this way, you can access the different commands directly from the PHP-FPM container : 

```bash
docker exec -it project_blackfire sh # Name of the container is up to you.
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
docker exec -it project_blackfire sh

blackfire curl http://172.20.0.1:PORT/ # For development env
```

In order to keep the testing logic and profiling "vision" away from the "core" logic, 
we use [Blackfire-Player](https://blackfire.io/docs/player/index),
this tool is used in order to test EVERY pages and and ensure that we have the best 
performances and testing experience.

During the developement phase, you MUST use this tools in order to test every page
you build, let's launch the process : 

```bash
docker exec -it project_php-fpm sh

blackfire-player run scenarios/dev.bkf # For development tests
blackfire-player run scenarios/prod.bkf # For production tests
```

The approach used is to define folder who contains the different parts of the application, 
this way, this way, the logic can be tested away from the api if you work on the web application.

In order to be effective and help to improve the application, you MUST write tests for both
version (production and development) and both "part" (API and Web) if your features is 
concerned by both parts.

## Frontend assets

To define

## Production

To define
