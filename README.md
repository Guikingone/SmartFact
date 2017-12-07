# SmartFact

The source code of the web application/API used for SmartFact mobile application.

## Build

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e255fc48-1265-4a49-a950-4c71fee7d0ef/mini.png)](https://insight.sensiolabs.com/projects/e255fc48-1265-4a49-a950-4c71fee7d0ef)
[![Maintainability](https://api.codeclimate.com/v1/badges/d996390800b4a91d6247/maintainability)](https://codeclimate.com/github/Guikingone/SmartFact/maintainability)
[![Build Status](https://travis-ci.org/Guikingone/SmartFact.svg?branch=master)](https://travis-ci.org/Guikingone/SmartFact)

## Usage

Once you've installed Docker, time to build the project.

This project use Docker environment files in order to allow the configuration according to your needs,
this way, you NEED to define a .env file in order to launch the build.

**_In order to perform better, Docker can block your dependencies installation and return an error
or never change your php configuration, we recommend to delete all your images/containers
before building the project_**

```bash
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -a -q) -f # Only if you need to clean your images and containers stored locally.
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
./bin/console d:s:c 

# Fixtures
./bin/console d:f:l -n
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

## Quality

As define in the internal guidelines, this project follow the more strict rules for
quality and best practices, this way, we include PHP-CS-FIXER for the code quality and PSR 
respect, here's the process to use it : 

```bash
docker exec -it container_php-fpm sh

# Once the container is launched
php-cs-fixer fix src/ # Every time you work on a new feature.
php-cs-fixer fix tests/ # Once you've added new tests
```

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

## Frontend

This project use React in order to manage the frontend part, this way, 
we use [Symfony/Encore]('https://symfony.com/doc/current/frontend.html').

### Development 

In order to achieve the development environment, we use Docker and NodeJS, once the project is build, let's compile the assets : 

```bash
./node_modules/.bin/encore dev --watch # Development approach using the watcher.
```

### Production

In production environment, the assets preparation is even easier, once the project is build and ready, just use
Encore shortcuts to build the production assets : 

```bash
./node_modules/.bin/encore production # Compiled once and optimized.
```
