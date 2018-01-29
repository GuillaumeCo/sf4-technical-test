#!/bin/bash

PARAMETERS_FILE=$PWD"/app/config/parameters.yml"
ENV_FILE=$PWD"/.env"

echo
echo "Configuration du fichier parameters.yml et .env"
echo

echo -n "DB_USERNAME : "
read DB_USERNAME
echo -n "DB_PASSWORD : "
read DB_PASSWORD

rm $PARAMETERS_FILE
touch $PARAMETERS_FILE

echo "parameters:
    database_host: db
    database_port: null
    database_name: sf4-technical-test
    database_user: "$DB_USERNAME"
    database_password: "$DB_PASSWORD"
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: test@test.com
    mailer_password: null
    secret: 8c8b0e2d5f1003f8a33ff5d106d7e60ba9332f9f
    base_uri_github: 'https://api.github.com'" >> $PARAMETERS_FILE

rm $ENV_FILE
touch $ENV_FILE

echo "DATABASE_USER="$DB_USERNAME"
DATABASE_PASSWORD="$DB_PASSWORD"
MAILER_USER=test@test.com" >> $ENV_FILE

echo

docker pull jwilder/nginx-proxy
docker pull mysql/mysql-server:5.7 
docker pull phpmyadmin/phpmyadmin:4.6.0-1

docker build -t sf4-technical-test:$1 -f docker/Dockerfile_symfony docker/

docker run --rm -i --tty -v $PWD:/app composer install

chmod -R 777 var/cache
chmod -R 777 var/logs

mkdir var/sessions
chmod -R 777 var/sessions

docker-compose up -d

docker exec -it sf4-technical-test /usr/local/bin/php bin/console doctrine:schema:update --force

docker exec -it sf4-technical-test /usr/local/bin/php bin/console cache:clear --env=prod

docker exec -it sf4-technical-test /usr/local/bin/php bin/console assets:install

echo
echo
echo "Installation terminée"
echo
echo "Site accessible sur http://sf4-technical-test.localhost:4200"
echo
echo "phpMyAdmin accessible sur http://phpmyadmin.localhost:4200"
echo
echo "Commande 'make stop' pour arrêter les dockers"
echo
echo "Commande 'make start' pour démarrer les dockers"
echo