FROM php:8.0-fpm

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN pecl install xdebug-3.0.1 && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/wild