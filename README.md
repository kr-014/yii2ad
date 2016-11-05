Parus Basic Template
=============
cdsfdfd
Parus Basic template is a skeleton [Parus](https://github.com/rokorolov/parus) Content Management application.

## Minimal system requirements:

* PHP 5.6 or higher
* MySQL 5.5+
* Needed PHP modules
    * GD PHP Extension
    * PDO PHP Extension
    * INTL PHP Extension

## Installation and getting started

1. There are 3 ways of installation:
  * Use GitHub: simply download the zip
  * Use Git: `git clone git@github.com:rokorolov/parus-basic-app.git`
  * Use Composer: `composer create-project --prefer-dist rokorolov/parus-basic-app parus-basic` (If you do not have Composer-Asset-Plugin installed, you may install it by running command: `composer global require "fxp/composer-asset-plugin:1.2.0"`)
2. Enter your database details into `config/db.php`.
4. Run `php yii run/init` and follow the instructions to setup the application.
5. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "web" folder.

## Admin login details

- Url: sites-public-url/admin
- Admin user is 'admin' with password 'password'.

## Demo
- [Demo](http://avaliany.com/admin) ( username: 'admin', password: 'password')

## Current project status

Parus is in alpha stage, so everything is not finished and can be changed at any time.
