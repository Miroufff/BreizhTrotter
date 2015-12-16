Breizh Trotteur Installation
============================


## Project install

Require -> Git, Composer

	git clone https://github.com/GroupBreizhTrotter/BreizhTrotter.git
	composer update
============================

## Start Server

	php app/console server:run

============================

## Use stylesheet compilator / Gulp

Require -> Npm

###Gulp install

	npm install -g gulp
	npm install --save-dev gulp
	npm install --save-dev gulp-sass

#### Compile
	gulp sass

#### Watcher
	gulp watch

=============================

## ORM / Doctrine

####List doctrine command
	php app/console doctrine

####Create database
	php app/console doctrine:database:create

####Generate entity
	php app/console generate:doctrine:entity

####Generate schema
	php app/console doctrine:schema:update --force
	
=============================

## FOSUserBundle

#### Create User
	php app/console fos:user:create

