FROM composer:1.7 AS vendor
COPY database/ database/
COPY tests/ tests/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --prefer-dist

FROM php:7.4-apache

RUN apt-get update
RUN a2enmod rewrite

COPY . /var/www/html
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

COPY --from=vendor /app/vendor/ /var/www/html/vendor/

RUN chown -R www-data:www-data /var/www/html/storage

WORKDIR /var/www/html
