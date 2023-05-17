# Setup #

## Local Development with SQLite ##

- To install dependencies run `composer install`
- To create database table run `php bin/console migrations:execute --up 'Racoon\Migrations\Version20230420123505'`
- To expose the API run `php -S localhost:9300 -t public`
- To expose the Frontend run `php -S localhost:9400 -t public`