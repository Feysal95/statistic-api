FROM php:8.2-fpm-alpine as base
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY .docker/php/www.conf /etc/php/8.2/fpm/pool.d/www.conf

# Установка bash
RUN apk update && \
    apk add --no-cache bash

RUN apk add --no-cache \
        icu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install opcache

# Установка Composer и добавление его в PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    ln -s /usr/local/bin/composer /usr/bin/composer

RUN composer self-update

### IMAGE FOR LOCAL MACHINES ###
FROM base as base-dev
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ENV APP_ENV=local
ENV PHP_IDE_CONFIG="serverName=localhost"
COPY --chown=www-data . /var/www
WORKDIR /var/www
USER root
EXPOSE 9000

FROM base as application
ENV APP_ENV=dev
COPY --chown=www-data . /var/www

USER www-data
WORKDIR /var/www
RUN composer install --prefer-dist --optimize-autoloader --no-interaction

ENTRYPOINT ["php-fpm"]
CMD ["--nodaemonize"]
EXPOSE 9000

FROM base as application_prod
ENV APP_ENV=prod
COPY --chown=www-data . /var/www

USER www-data
WORKDIR /var/www
RUN composer install --prefer-dist --optimize-autoloader --no-interaction --no-dev

ENTRYPOINT ["php-fpm"]
CMD ["--nodaemonize"]
EXPOSE 9000
