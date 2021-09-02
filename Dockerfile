FROM php:7.4-apache

MAINTAINER PlanetaHuerto-dev <dev@planetahuerto.es>

#UPDATE SYSTEM
RUN apt-get update -y && \
    apt-get install -y git zip unzip

#COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

#XDEBUG
RUN pecl install xdebug-2.9.0
RUN docker-php-ext-enable xdebug
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini

