FROM php:8.2-apache

WORKDIR /var/www

RUN apt-get update && apt-get install -y  \
  libfreetype6-dev \
  libjpeg-dev \
  libzip-dev \
  libpng-dev \
  libwebp-dev \
  --no-install-recommends \
  && docker-php-ext-enable opcache \
  && docker-php-ext-install zip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql -j$(nproc) gd \
  && apt-get autoclean -y \
  && rm -rf /var/lib/apt/lists/* 

ADD . .

# CONFIGURAÇÕES DO COMPOSER
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -s https://getcomposer.org/installer | php
RUN alias composer='php composer.phar'

RUN chown -R www-data:www-data /var/www
