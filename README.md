# Shopping List Demo #

This demo uses Docker to expose both the frontend and backend services. The frontend 
is built with Html, Css and JavaScript meanwhile the backend is built using PHP.

## Setting up the Solution ##

> It is assumed that the machine in which this solution would be deployed 
> has Docker Runtime support.

- Clone this repository into your designated workspace

- Run `docker-compose up -d` to bring up all services into life

- Once services are running then we need to execute command to create database 
  table(s) we will need for the backend
  
`docker exec -it coolstuff_api sh`

Once inside the container run `bin/console` (see sample output below).

```
$ bin/console
Shopping List Items 0.1.0

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  completion                        Dump the shell completion script
  help                              Display help for a command
  list                              List commands
 migrations
  migrations:current                [current] Outputs the current version
  migrations:diff                   [diff] Generate a migration by comparing your current database to your mapping information.
  migrations:dump-schema            [dump-schema] Dump the schema for your database to a migration.
  migrations:execute                [execute] Execute one or more migration versions up or down manually.
  migrations:generate               [generate] Generate a blank migration class.
  migrations:latest                 [latest] Outputs the latest version
  migrations:list                   [list-migrations] Display a list of all available migrations and their status.
  migrations:migrate                [migrate] Execute a migration to a specified version or the latest available version.
  migrations:rollup                 [rollup] Rollup migrations by deleting all tracked versions and insert the one version that exists.
  migrations:status                 [status] View the status of a set of migrations.
  migrations:sync-metadata-storage  [sync-metadata-storage] Ensures that the metadata storage is at the latest version.
  migrations:up-to-date             [up-to-date] Tells you if your schema is up-to-date.
  migrations:version                [version] Manually add and delete migration versions from the version table.
```
  
> The command to run in order to create the database table would be `migrations:migrate`.

Once all the steps above have been performed the frontend is ready for testing, or rather to be accessed.

## Accessing the frontend ##

If we run `docker-compose ps` we can see the list of all our services. Below is an example:

```
┌─[MacBook-Pro][~/devhouse/assessments/racoon][master 😱]
└──╼ docker-compose ps
        Name                      Command               State                     Ports
----------------------------------------------------------------------------------------------------------
coolstuff_api          docker-php-entrypoint php-fpm    Up      9000/tcp
coolstuff_app          apache2ctl -D FOREGROUND         Up      0.0.0.0:9600->80/tcp
coolstuff_bes          /docker-entrypoint.sh ngin ...   Up      0.0.0.0:434->443/tcp, 0.0.0.0:9200->80/tcp
coolstuff_mysql        docker-entrypoint.sh mysqld      Up      0.0.0.0:6033->3306/tcp, 33060/tcp
coolstuff_phpmyadmin   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8081->80/tcp
```
You can then visit `0.0.0.0:9600` to access the frontend and carry on testing.