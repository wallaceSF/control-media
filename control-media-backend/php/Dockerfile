FROM php

RUN apt-get update
RUN apt-get install -y libpq-dev git libzip-dev unzip
RUN docker-php-ext-configure zip --with-libzip 
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql zip
RUN docker-php-ext-install opcache

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug



CMD ["php", "-S", "0.0.0.0:8100", "-t", "public"]
