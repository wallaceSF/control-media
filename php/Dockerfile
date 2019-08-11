FROM php

RUN apt-get update
RUN apt-get install -y libpq-dev git libzip-dev unzip
RUN docker-php-ext-configure zip --with-libzip 
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql zip
RUN docker-php-ext-install opcache

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

RUN chown -R ${UID}:${GID} /root/.composer
RUN mkdir -p /.composer && chown -R ${UID}:${GID} /.composer

VOLUME /root/.composer
VOLUME /.composer

