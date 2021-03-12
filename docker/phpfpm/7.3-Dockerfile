FROM php:7.3-fpm

RUN  docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql \
    && docker-php-ext-install mysqli \
    && pecl install redis \
    && docker-php-ext-enable redis