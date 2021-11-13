# AC Web Agency : Test de recrutement développeur sénior.

## Début de projet
 * git clone -b test-symfony https://github.com/AC-Web-Agency/test-de-recrutement.git
 * retrait du commentaire de public/index.php::8
 * retrait du commentaire du composer.json : "symfony/runtime": "5.3.*"
 * composer update
 * modification du .env et connexion sqlite
 * symfony server:ca:install

## Installation rapide des dépendances
* composer require doctrine/orm
* composer require doctrine/doctrine-bundle
* composer require doctrine/annotations
* composer require symfony/twig-bundle
* composer require symfony/webpack-encore-bundle
* composer require symfony/security-bundle
* composer require sensio/framework-extra-bundle
* composer require symfony/serializer
* composer require symfony/mime
* composer require --dev doctrine/doctrine-fixtures-bundle
* composer require --dev symfony/maker-bundle

## Yarn (commandes utilisées)
* yarn install
* yarn encore dev
* yarn run dev-server

## Création du schéma de la BDD
* Film (nom, image, ManyToOne avec Genre)
* Genre (nom)
* Utilisateur

## Sécurisation
Création de l'authenticator et configuration de la sécurité (php bin/console make:auth, config/packages/security.yaml, création du UserDataPersister.php)

## Création de fixtures comme prérequis pour les tests (utilisateurs, films et genres)
Admin:
 * email: j.doe@allocinoche.com
 * mot de passe: test

Utilisateur simple:
 * email: noel.flantier@oss.fr
 * mot de passe: test

## Création d'une API
* méthode du CRUD de Film dans src/Controller/FilmController.php
* Développement d'une méthode "search" dans src/Repository/FilmRepository.php afin de filtrer sur le nom et le genre à partir d'un terme de recherche
* Je fais le choix de centraliser la gestion de Film dans src/Service/FilmService (sera réutilisé par l'administrateur)

## Développement du front
* Développement du layout base.html.twig avec le moteur de recherche en entête
* Le frontend contient uniquement la page listant les films
* Affichage complet de la fiche d'un film dans la modale lors du clic sur un film ou un résultat de recherche

## Développement du backoffice
* Développement d'un service pour uploader l'image d'un film : /src/Service/UploadService.php
* Développement des templates et du Controller pour gérer le CRUD de Film