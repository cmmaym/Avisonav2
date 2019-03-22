FROM php:7.2-fpm-alpine

WORKDIR /var/www

RUN apk update && apk add \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
    && apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        pdo_mysql \
        zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug

RUN addgroup -g 1000 -S www \
    && adduser -u 1000 -D -S -G www www

COPY . /var/www

COPY --chown=www:www . /var/www

# Change current user to www
USER www

EXPOSE 9000