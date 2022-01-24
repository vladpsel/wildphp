# wildphp
My tiny and simple, multilingual by default, framework (or presets) which inspired by Symfony. I create and support it in education and presentation purposes. Write own small "pet" projects with it.

I`m not try to "reinvent bicycle" or "create new enterprise framework".I just learning, training and trying to explore what can i do.

Current version - alpha.1.0

## Required tools
- php8.0 and higher 
- composer
or 
- docker with docker-compose

## Installation

- Download/get "main" branch into dir
- Remove .git directory if you plan setup own git project (optional)
- Remove docker dir if you have own enviroment
- run composer init to setup autoloader and other utilities

## Setup project with docker
- Download/get "main" branch into dir
- Remove .git directory if you plan setup own git project (optional)
- move to dir "docker"
- open command line and write next rules
```
set -a
source ../.env.local 
or
source ../.env
```
- build docker image
- run image with 
```
docker-compose up -d
```

### Manual (from github)
- download lib files from "main" branch and place them into work project dir
- init composer and update autoloader with adding "wild" directory into composer.json
- write code inside the borders of your project

### Composer
Composer install is in development

## Environment presets
Wild has some default presets for docker configuration. They located in "docker" dir.
Presets include nginx, php, mysql and phpmyadmin;

Setup environmental for Wildphp-project:

- go to "docker" dir
- launch docker engine (if it not launched)
- open command line
- write docker-compose build 
- write docker-compose run -d
- go to docker-php container command-line
- write
```
composer init
```
- write code :)

## Library architecture

## Routing

## Database connection

## Controllers

## View

## Models

## Components

## Helper files

Files for help to setup project in different stack, ex. docker directory with ready docker-default images for default preset.


### Feature in near future
- register it as package, add composer instalation support
- rewrite render component
- add dependency injection support
- add cli commands support
- create site with detail documentation
