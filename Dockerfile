# Stage 1
FROM composer:1.8.4 AS composer

COPY composer.json composer.lock /app/
COPY database /app/database

WORKDIR /app

# Install libraries using composer image
RUN composer install --ignore-platform-reqs --no-dev --no-scripts

# Stage 2
FROM php:7.2-fpm-alpine

RUN apk update && apk add --virtual .build-deps $PHPIZE_DEPS \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        pdo_mysql \
        zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && rm -rf /var/cache/apk/* \
    && apk del .build-deps
RUN addgroup -g 1000 -S www \
    && adduser -u 1000 -D -S -G www www

WORKDIR /var/www/html

COPY . /var/www/html
COPY --chown=www:www . /var/www/html
COPY --chown=www:www --from=composer /app/vendor/ /var/www/html/vendor/

USER www

EXPOSE 9000