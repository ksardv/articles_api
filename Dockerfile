FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y libmcrypt-dev autoconf libc-dev libzip-dev libxml2-dev libpng-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install gd pdo_mysql intl zip unzip

WORKDIR "/var/www/articles_api"

RUN chown -R www-data:www-data /var/www
USER www-data