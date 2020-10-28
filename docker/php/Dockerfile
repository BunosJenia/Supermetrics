FROM php:7.4.6-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y git unzip curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set up PHP
COPY docker/php/php.ini $PHP_INI_DIR