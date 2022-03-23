FROM php:8.1-cli-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /app
COPY . /app

RUN apk update && \
    apk add git libzip-dev zlib-dev zip unzip && \
    docker-php-ext-install zip

RUN echo "memory_limit=1024M" > /usr/local/etc/php/conf.d/memory-limit.ini
RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    php composer.phar install --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative  --no-interaction && \
    php composer.phar clear-cache && \
    rm -rf /usr/src/php