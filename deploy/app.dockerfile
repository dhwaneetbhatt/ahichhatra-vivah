FROM php:5.6.40-fpm-alpine

RUN apk update \
&& apk add \    
    libmcrypt-dev \
    mysql-client \
    && docker-php-ext-install \
    mcrypt \
    pdo_mysql

COPY . /var/www
WORKDIR /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 777 /var/www/app/storage
