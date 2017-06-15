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
- Communication entre applications mobiles et serveur
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

In order to make this project easy to use and maintain, the choice was dedicated to use Docker, 
this way, our code and further development can easily be tested and manage trough the lifecyle.

In order to use Docker, here is the process : 

```bash
docker-composer up -d --build
```

This command prepare and build all the container phase, once this is done, time to open the magic door
and use commands : 

```bash
docker-compose exex -it smartfact_php sh
```

Once into the container, let's clear the cache :

```bash
rm -rf var/cache/*
```

OR 

```bash
./bin/console c:c 
```

_Please notice that using the Symfony console is a little bit longer and probably not too friendly for
bash users._

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

## Tests coverage

This project is completely tested and followed by PHPUnit, this way, our code is easily maintainable
and upgradable, here's is the details of the coverage : 


