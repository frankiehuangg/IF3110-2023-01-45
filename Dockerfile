FROM php:8.0-apache
EXPOSE 8008

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
