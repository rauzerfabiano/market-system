FROM php:8.0.1-fpm

RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        g++ \
        libjpeg62-turbo-dev \
        libzip-dev \
        libpng-dev \
        libwebp-dev \
        libfreetype6-dev \
        libxml2-dev \
        git \
        zip \
        unzip \
        libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-webp --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_pgsql   # Adicione esta linha para instalar o driver PDO PostgreSQL

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && HASH=`curl -sS https://composer.github.io/installer.sig` \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer --version=2.4.2 \
    && rm composer-setup.php

WORKDIR /var/www/html

CMD cd /var/www/html/market-api \
    && composer install \
    && cd public/ && php -S 0.0.0.0:9090

EXPOSE 9090

