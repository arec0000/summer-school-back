FROM php:fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

WORKDIR /var/www/project

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && chmod +x /usr/bin/wait-for-it \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sS https://get.symfony.com/cli/installer | bash

CMD wait-for-it database:3306 -- bin/console doctrine:migrations:diff ; bin/console doctrine:migrations:migrate ; php-fpm
